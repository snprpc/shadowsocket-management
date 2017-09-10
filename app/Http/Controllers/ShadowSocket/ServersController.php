<?php

namespace App\Http\Controllers\ShadowSocket;

use App\Model\ShadowSocket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ServersController extends Controller
{

    //
    public function allocation_server () {
        $servers = $this->getServerIp ();
        // $localIp = \App\Http\Controllers\ShadowSocket\ServersController::getRealIp();
        $localIp = "183.160.167.170";
        $directory = "ShadowSocket/NetStatus/"."$localIp";

        Storage::makeDirectory($directory);

        $files = Storage::files($directory);
        // print_r($files);
        $netinfos = collect();
        // echo $collection;
        foreach ($files as $file) {
            $contents = json_decode(Storage::get($file), true);
            $netinfos->prepend($contents, $contents['ip']);
        }
        // print_r($netinfos->toArray());
        $netstatus = $netinfos->toArray();
        // print_r($netstatus);
        // foreach ($netstatus as $servers) {
        //   print_r($servers);
        //   echo "<br />";
        //   echo  $servers['ip'];
        //   echo "<br />";
        // }
        return view('ShadowSocket/user/show_netstatus')
          ->with('servers', $netstatus);
    }

    public function allocation_port (Request $request) {
      // echo $request->server_ip;
      $this->validate($request, [
              'server_ip' => 'required|ip',
          ]);

      $server = new \App\Model\ShadowSocket\Server;
      $server->server_ip = $request->server_ip;
      echo "1";
      $server = $server->where('server_ip',$server->server_ip)
                       ->where('isEnable',0)
                       ->firstOrFail();
      return $server->server_port;

    }
    public function getServerIp () {
      return \App\Model\ShadowSocket\Server::all()->groupBy('server_ip')->keys()->toArray();
    }

    public function getRealIp()
    {
      $ip=false;
      if(!empty($_SERVER["HTTP_CLIENT_IP"])){
        $ip = $_SERVER["HTTP_CLIENT_IP"];
      }
      if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
        if ($ip) {
          array_unshift($ips, $ip); $ip = FALSE;
        }
        for ($i = 0; $i < count($ips); $i++) {
          if (!eregi ("^(10│172.16│192.168).", $ips[$i])) {
            $ip = $ips[$i];
            break;
          }
        }
      }
      return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
    }


}
