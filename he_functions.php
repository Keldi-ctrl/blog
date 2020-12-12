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
if (!function_exists('file_get_contents_curl')) {
  function file_get_contents_curl($url)
  {
    //Get server path
    $ca_cert_bundle = 'public/certs/cacert.pem';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($ch, CURLOPT_CAINFO, $ca_cert_bundle);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
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

if (!function_exists('print_log')) {
  function print_log($var, $log_file = 'print.log')
  {
    $logs_dir = '/mnt/www/socialshopwave.com/temporary/log/';
    $file_path = $logs_dir . $log_file;

    $logger = new Phalcon\Logger\Adapter\File($file_path);
    $logger->error(print_r($var, true) . "\n\r");
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

if (!function_exists('heSendErrorMail')) {
  function heSendErrorMail($subject, $error, $recipient = false)
  {
    $subject = APPLICATION_ENV . ': ' . $subject;
    $error .= "\r\n" . "SERVER: " . (isset($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : 'Strange');

    \Sentry\captureMessage($subject . ' ' . $error);
  }
}
if (!function_exists('logException')) {
  function logException(\Exception $e)
  {
    \Sentry\captureException($e);
  }
}

if (!function_exists('print_slack')) {
  function print_slack($var, $channel = 'debug', $show_called_line = true, $format = null)
  {
    $info = debug_backtrace();
    $integrationUrl = ' https://hooks.slack.com/services/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';
    $rawData = APPLICATION_ENV . ':' . (is_string($var) ? $var : print_r($var, true)) . "\n";
    if ($show_called_line)
      $rawData .= "File: {$info[0]['file']}:{$info[0]['line']}\n";
    $rawData .= "\r";

    if ($format == 'pre') {
      $rawData = "```$rawData```";
    } elseif ($format == 'c') {
      $rawData = "`$rawData`";
    } elseif ($format == 'b') {
      $rawData = "*$rawData*";
    } elseif ($format == 's') {
      $rawData = "~$rawData~";
    } elseif ($format == 'i') {
      $rawData = "_" . $rawData . "_";
    }

    $message = json_encode($rawData, JSON_HEX_APOS);
    $cmd = <<<MYCODE
curl -X POST --data-urlencode 'payload={"channel": "#$channel", "username": "Taskflowy", "text": $message, "icon_url": "http://pbs.twimg.com/profile_images/3466225963/b844139b08cb9903dbd3b0b90f4d4af8_normal.png", "unfurl_links": false, "unfurl_media": false}' $integrationUrl  > /dev/null 2>&1 &
MYCODE;

    exec($cmd, $output, $exit);
    return $exit == 0;
  }
}

if (!function_exists('do_curl')) {
  function do_curl($url, $data = [], $timeout_ms = 200)
  {
    $data['key'] = generateUniqueCode();
    $di = \Phalcon\DI::getDefault();
    if ($di->has('client')) {
      $shop = $di->get('client');
      $url .= (strpos($url, '?') !== false ? '&' : '?') . 'shop=' . $shop->shop;
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT_MS, $timeout_ms);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
  }
}

if (!function_exists('phalconModelError')) {
  function phalconModelErrors(array $messages, $throw = true)
  {
    /**
     * @var $message \Phalcon\Mvc\Model\MessageInterface
     */
    $msg = '';
    foreach ($messages as $message) {
      $msg .= '\n' . $message->getMessage();
    }

    $e = new \Exception($msg);
    if ($throw)
      throw $e;
    else {
      $msg = "\r\n SHOP: " . $_GET['shop'] . $msg;
      logException(new \Exception('SSW ERROR: ' . $msg));
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


if (!function_exists('print_t')) {
  function print_t($message)
  {
    $host = "https://api.telegram.org/bot";
    $token = "560656480:AAEfWdQhsJvTJ-UiT2QPncChdj7JFuhhiBI";
    $channel = "socialshopwave";
    $url = $host . $token . '/sendmessage?chat_id=@' . $channel . '&text=' . $message;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;

  }
}

if (!function_exists('telegram')) {
  function telegram($message)
  {
    return print_t($message);
  }
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