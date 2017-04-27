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

// Route::get('/', "Firsthi@index");


//     Route::get('/msg_list', "Msg@listt");
       
//     Route::get('/msg_reply', "Msg@reply");


// Route::get('/{id?}', function ($id=123) {
//     return $id;
// });


// Route::get('/{id}', function ($id=123) {
//     return $id;
// })->where('id', '[0-9].+');
use Illuminate\Support\Facades\Input;
Route::get('/msg', function()
{
  $results = DB::table('msg_list')
               ->select( 'msg_list.MSG_NO', 
               					 'MSG_TITLE',
               					 'MSG_TIME', 
               					 'msg_list.PERSON_NO', 
               					 DB::raw('COUNT(msg_reply.REPLY_NO) as REPLY_COUNT'),
               					 DB::raw('MAX(msg_reply.REPLY_TIME) as REPLY_TIME')
               					 )
               ->leftjoin('msg_reply', 'msg_list.MSG_NO', '=', 'msg_reply.MSG_NO')
               ->groupBy('msg_list.MSG_NO')
               ->get();
  return View::make('msg_list')->with(compact("results"));

});

Route::get('/msg/{id?}', function($id)
{
    //引入檔案
    // return View::make('msg',array());
  $results = DB::table('msg_reply')
               ->select( 'REPLY_MESSAGE', 'REPLY_TIME', 'msg_reply.PERSON_NO' , 'msg_list.MSG_TITLE') 
               ->leftjoin('msg_list', 'msg_reply.MSG_NO' , '=', 'msg_list.MSG_NO')
               ->where('msg_reply.MSG_NO', '=', $id)
               ->get(); 
// dd($results);
  // return View::make('msg_reply',array('msg' =>"" ));
  return View::make('msg_reply')->with(compact("results"));
});


Route::post('/msg/{id?}', function($id)
{
  if ( Input::has('REPLY_MESSAGE')  ) {
    $reply_message = Input::get('REPLY_MESSAGE');
    
    DB::table('msg_reply')
      ->insert( array('REPLY_MESSAGE' => $reply_message ,
      	              'MSG_NO' => $id ,
      	              'PERSON_NO' => '1' ,
      	              'REPLY_TIME' => date("Y-m-d H:i:s")
      	              ) 
      				);

    // if( DB::table('msg_reply')
    //       ->insert( array('REPLY_MESSAGE' => $reply_content  ) 
    //   ){
    //   $msg="新增成功";
    // } else {
    //   $msg="新增失敗";
    // }
  } else {
    $msg="請輸入標題及訊息內容";
  }

  $results = DB::table('msg_reply')
               ->select( 'REPLY_MESSAGE', 'REPLY_TIME', 'msg_reply.PERSON_NO' , 'msg_list.MSG_TITLE') 
               ->leftjoin('msg_list', 'msg_reply.MSG_NO' , '=', 'msg_list.MSG_NO')
               ->get(); 

  
  // return View::make('msg_reply')->with( compact("results") );
  return Redirect::to('/msg/reply')->with(compact("msg"));             
});




