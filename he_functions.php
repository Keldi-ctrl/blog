<?php
if (!function_exists('hash_equals')) {
  function hash_equals($str1, $str2)
  {
    if (strlen($str1) != strlen($str2)) {
      return false;
    } else {
      $res = $str1 ^ $str2;
      $ret = 0;
      for ($i = strlen($res) - 1; $i >= 0; $i--) $ret |= ord($res[$i]);
      return !$ret;
    }
  }
}

if (!function_exists('print_arr')) {
  function print_arr($var, $return = false, $special = true)
  {
    $type = gettype($var);

    $out = print_r($var, true);
    if ($special) {
      $out = htmlspecialchars($out);
    }
    $out = str_replace(' ', '&nbsp;', $out);
    if ($type == 'boolean') {
      $content = $var ? 'true' : 'false';
    } else {
      $content = nl2br($out);
    }


    $count = '';
    if ($type == 'array') {
      $count = ' (' . count($var) . ' items)';
    }

    $out = '<div style="
       border:2px inset #666;
       background:black;
       font-family:monospace;
       font-size:12px;
       color:#6F6;
       text-align:left;
       margin:20px;
       word-break: break-word;
       padding:16px">
         <span style="color: #F66">(' . $type . ')</span>' . $count . ' ' . $content . '</div><br /><br />';

    if (!$return)
      echo $out;
    else
      return $out;
  }

  function print_die($var, $return = false, $special = true)
  {
    print_arr($var, $return, $special);
    $info = debug_backtrace();
    print_arr("File: {$info[0]['file']} Line: {$info[0]['line']}");
    die ();
  }
}


if (!function_exists('is_valid_request')) {
  function is_valid_request($query_params, $shared_secret)
  {
    $seconds_in_a_day = 24 * 60 * 60;

    if (!isset($query_params['timestamp'], $query_params['signature'])) {
      return false;
    }

    $older_than_a_day = $query_params['timestamp'] < (time() - $seconds_in_a_day);
    if ($older_than_a_day) {
      return false;
    }

    $signature = $query_params['signature'];
    unset($query_params['signature']);
//    unset($query_params['_url']);
//    unset($query_params['path_prefix']);
    $params = array();
    print_arr($query_params);
    foreach ($query_params as $key => $val) {
      $filteredVal = str_replace('%', '%25', str_replace('&', '%26', $val));
      $params[] = $key . '=' . $filteredVal;
    }
    sort($params);
    print_arr($_SERVER['QUERY_STRING']);
    $params = implode('&', $params);
    print_arr($params);
//    print_die($_SERVER['QUERY_STRING']);
    print_arr(hash_hmac('sha256', $params, $shared_secret));
    print_die($signature);
    return (hash_hmac('sha256', implode('', $params), $shared_secret) === $signature);
  }
}

if (!function_exists('urlToLink')) {
  /**
   * Turn all URLs in clickable links.
   *
   * @param string $value
   * @param array $protocols http/https, ftp, mail, twitter
   * @param array $attributes
   * @param string $mode normal or all
   * @return string
   */
  function urlToLink($value, $protocols = array('http', 'mail'), array $attributes = array())
  {
    // Link attributes
    $attr = '';
    foreach ($attributes as $key => $val) {
      $attr = ' ' . $key . '="' . htmlentities($val) . '"';
    }

    $links = array();

    // Extract existing links and tags
    $value = preg_replace_callback('~(<a .*?>.*?</a>|<.*?>)~i', function ($match) use (&$links) {
      return '<' . array_push($links, $match[1]) . '>';
    }, $value);

    // Extract text links for each protocol
    foreach ((array)$protocols as $protocol) {
      switch ($protocol) {
        case 'http':
        case 'https':
          $value = preg_replace_callback('~(?:(https?)://([^\s<]+)|(www\.[^\s<]+?\.[^\s<]+))(?<![\.,:])~i', function ($match) use ($protocol, &$links, $attr) {
            if ($match[1]) $protocol = $match[1];
            $link = $match[2] ?: $match[3];
            return '<' . array_push($links, "<a $attr href=\"$protocol://$link\" target='_blank'>$link</a>") . '>';
          }, $value);
          break;
        case 'mail':
          $value = preg_replace_callback('~([^\s<]+?@[^\s<]+?\.[^\s<]+)(?<![\.,:])~', function ($match) use (&$links, $attr) {
            return '<' . array_push($links, "<a $attr href=\"mailto:{$match[1]}\">{$match[1]}</a>") . '>';
          }, $value);
          break;
        case 'twitter':
          $value = preg_replace_callback('~(?<!\w)[@#](\w++)~', function ($match) use (&$links, $attr) {
            return '<' . array_push($links, "<a $attr target=\"_blank\" href=\"https://twitter.com/" . ($match[0][0] == '@' ? '' : 'search/%23') . $match[1] . "\">{$match[0]}</a>") . '>';
          }, $value);
          break;
        default:
          $value = preg_replace_callback('~' . preg_quote($protocol, '~') . '://([^\s<]+?)(?<![\.,:])~i', function ($match) use ($protocol, &$links, $attr) {
            return '<' . array_push($links, "<a $attr target='_blank' href=\"$protocol://{$match[1]}\">{$match[1]}</a>") . '>';
          }, $value);
          break;
      }
    }

    // Insert all link
    return preg_replace_callback('/<(\d+)>/', function ($match) use (&$links) {
      return $links[$match[1] - 1];
    }, $value);
  }
}

if (!function_exists('isValidUrl')) {
  function isValidUrl($url)
  {
    if ($url[0] == 'w') {
      $url = 'http://' . $url;
    }
    if (preg_match('/^(?:([a-z]+):(?:([a-z]*):)?\/\/)?(?:([^:@]*)(?::([^:@]*))?@)?((?:[a-z0-9_-]+\.)+[a-z]{2,}|localhost|(?:(?:[01]?\d\d?|2[0-4]\d|25[0-5])\.){3}(?:(?:[01]?\d\d?|2[0-4]\d|25[0-5])))(?::(\d+))?(?:([^:\?\#]+))?(?:\?([^\#]+))?(?:\#([^\s]+))?$/i', $url)) {
      return true;
    }
    return false;
  }
}

if (!function_exists('check_remote_file')) {
  function check_remote_file($url)
  {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    // don't download content
    curl_setopt($ch, CURLOPT_NOBODY, 1);
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    if (curl_exec($ch) !== FALSE) {
      return true;
    } else {
      return false;
    }
  }
}

function check4UniqueKey($uniqueKey)
{
  $now = intval((time()/60));
  $_10min_earlier = $now - 10;
  $valid = false;
  for( $i = $now; $i > $_10min_earlier; $i--) {
    if (md5(SSW_UNIQUE_KEY . $i) === $uniqueKey) {
      $valid = true;
      break;
    }
  }
  return $valid;
}

function generateUniqueCode()
{
  return md5(SSW_UNIQUE_KEY . intval((time()/60)));
}

function generateCode4UniqueKey()
{
  return md5(SSW_UNIQUE_KEY . floor(time() / 120));
}

function validateCode4UniqueKey($code)
{
  return generateCode4UniqueKey() == trim($code);
}


if (! function_exists("array_key_last")) {
  function array_key_last($array) {
    if (!is_array($array) || empty($array)) {
      return NULL;
    }

    return array_keys($array)[count($array)-1];
  }
}
if (! function_exists("array_keys_exists")) {
  function array_keys_exists($requiredKeys = [], $checkedArray = [])
  {
    if (count($requiredKeys) > 0 && $checkedArray > 0) {
      return count(array_intersect_key(array_flip($requiredKeys), $checkedArray)) === count($requiredKeys);
    }
    return false;
  }
}

if (! function_exists('encode_email')) {
  function encode_email(string $email)
  {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $token = md5('PREFIX');
      $prefix = substr($token, -5, 5);

      return $prefix . rtrim(base64_encode($email), '=');
    }

    return $email;
  }
}

if (! function_exists('decode_email')) {
  function decode_email(string $email)
  {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return $email;
    } else {
      $token = md5('PREFIX');
      $prefix = substr($token, -5, 5);

      return base64_decode(str_replace($prefix, "", $email));
    }
  }
}

if (!function_exists('between')) {
  function between($subject = 0, $param1 = 0, $param2 = 0)
  {
    if ($param1 < $param2) {
      $lower = $param1;
      $upper = $param2;
    } else {
      $lower = $param2;
      $upper = $lower;
    }
    return (($subject >= $lower) && ($subject <= $upper));
  }
}