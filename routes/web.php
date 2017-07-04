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

// Route::get('/register', function () {
//     return view('layouts/app');
// });


Route::get('/msg',"Msg@showMsgList");
Route::post('/msg',"Msg@changeMsgList");

Route::get('/msg/{id?}', "Msg@showMsgDetail");
Route::post('/msg/{id?}', "Msg@replyMsg");


Route::get('/game', "Game@showGame");
// Route::get('/enemies/{id?}', "Game@showEnemy");
Route::get('enemies/rowQuantity/{rowQuantity}/columnQuantity/{columnQuantity}/enemyQuantity/{enemyQuantity}', "Game@showEnemy");
// enemies.php?rowQuantity=7&columnQuantity=7&enemyQuantity=1 

