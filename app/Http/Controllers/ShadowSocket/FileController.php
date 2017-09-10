<?php

namespace App\Http\Controllers\ShadowSocket;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    //

    public function show_alldir (Request $request) {

      $directory = "ShadowSocket/NetStatus/";
      $directories = Storage::directories($directory);
      // print_r($directories);
      return $directories;
    }

    public function getClientIp($proxy_override = false) {
      if ($proxy_override) {
        /* 优先从代理那获取地址或者 HTTP_CLIENT_IP 没有值 */
        $ip = empty($_SERVER["HTTP_X_FORWARDED_FOR"]) ? (empty($_SERVER["HTTP_CLIENT_IP"]) ? NULL : $_SERVER["HTTP_CLIENT_IP"]) : $_SERVER["HTTP_X_FORWARDED_FOR"];
      } else {
        /* 取 HTTP_CLIENT_IP, 虽然这个值可以被伪造, 但被伪造之后 NS 会把客户端真实的 IP 附加在后面 */
        $ip = empty($_SERVER["HTTP_CLIENT_IP"]) ? NULL : $_SERVER["HTTP_CLIENT_IP"];
      }
      if (empty($ip)) {
        $ip = $_SERVER['REMOTE_ADDR'];
      }
      /* 真实的IP在以逗号分隔的最后一个, 当然如果没用代理, 没伪造IP, 就没有逗号分离的IP */
      if ($p = strrpos($ip, ",")) {
        $ip = substr($ip, $p+1);
      }
      return trim($ip);
  }
}
