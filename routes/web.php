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
use Illuminate\Support\Facades\Input;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', function () {
    return view('layouts/app');
});

//     Route::get('/msg_list', "Msg@listt");
       
//     Route::get('/msg_reply', "Msg@reply");


// Route::get('/{id?}', function ($id=123) {
//     return $id;
// });


// Route::get('/{id}', function ($id=123) {
//     return $id;
// })->where('id', '[0-9].+');
Route::get('/msg',"Msg@showMsgList");
Route::post('/msg',"Msg@changeMsgList");

Route::get('/msg/{id?}', "Msg@showMsgDetail");
Route::post('/msg/{id?}', "Msg@replyMsg");





Auth::routes();

Route::get('/home', 'HomeController@index');
