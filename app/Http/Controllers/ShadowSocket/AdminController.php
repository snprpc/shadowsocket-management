<?php

namespace App\Http\Controllers\ShadowSocket;

use App\Model\ShadowSocket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddServer;


class AdminController extends Controller
{
    //
    public function login () {
      echo "1";
    }

    public function store_server (AddServer $request) {

        $server_ports = array("8880", "8881", "8882", "8883", "8884", "8885", "8886", "8887", "8888", "8889");
        foreach ($server_ports as $server_port) {
            $server = new \App\Model\ShadowSocket\Server;
            $server->server_ip    =   $request->server_ip;
            $server->server_port  =   $server_port;
            $server->save();
        }
    }

    public function add_server () {

      return view('ShadowSocket/add_server');
    }
}
