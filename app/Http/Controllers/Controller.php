<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


  /** Helpers
   * @param $var
   * @param bool $return
   * @param bool $special
   */
  public function _die($var, $return = false, $special = true)
  {
    $this->print_arr($var, $return, $special);
    $info = debug_backtrace();
    $this->print_arr("File: {$info[0]['file']} Line: {$info[0]['line']}");
    die ();
  }

  private function print_arr($var, $return = false, $special = true)
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
}
