<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
$ShadowSocketRoot = "/sniper/ss-manager";

Route::get('/', function () {
    return view('welcome');
});
Route::get('illegal-request', function () {
    return view('errors.weberror.illegalRequest');
});
Route::get('/sniper/ss-manager/login', 'ShadowSocket\AdminController@login');
Route::get('/sniper/ss-manager/servers-manager/add-server', 'ShadowSocket\AdminController@add_server');
Route::post('/sniper/ss-manager/servers-manager/add-server', 'ShadowSocket\AdminController@store_server');
Route::post('/sniper/ss-manager/allocation-manager/allocation-port', 'ShadowSocket\ServersController@allocation_port');
Route::get('/sniper/ss-manager/allocation-manager/allocation-server', 'ShadowSocket\ServersController@allocation_server');
Route::get("$ShadowSocketRoot".'/files/list-serverdir', 'ShadowSocket\FileController@show_alldir')->middleware('client.ip');
