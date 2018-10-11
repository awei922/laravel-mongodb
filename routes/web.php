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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', 'LoginController@index')->name('login');
Route::post('/login', 'LoginController@login')->name('login.login');


Route::group(['middleware'=>'auth:web'],function(){
    Route::get('/admin', 'AdminController@index')->name('admin.index');
    Route::get('/loginOut', 'LoginController@loginOut')->name('login.loginOut');

    //日志管理
    Route::get('/admin/log', 'LogController@index')->name('log.index');
    Route::post('/admin/log/show', 'LogController@show')->name('log.show');

    //警报记录
    Route::get('/admin/alert', 'AlertController@index')->name('alert.index');

    //配置
    Route::get('/admin/config/allLogFields', 'ConfigController@allLogFields')->name('config.allLogFields');
    Route::post('/admin/config/setLogShowFields', 'ConfigController@setLogShowFields')->name('config.setLogShowFields');

    Route::get('/admin/config/alertConfig', 'ConfigController@alertConfig')->name('config.alertConfig');
    Route::post('/admin/config/doAlertConfig', 'ConfigController@doAlertConfig')->name('config.doAlertConfig');
});
