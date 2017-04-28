<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;
use View;
use Redirect;
class Msg extends Controller
{
    
		public function index( ){
			// return "index";
			  //   Route::get('/{id?}', function ($id=123) {
					//     return $id;
					// });
			return view('welcome');
		}

    public function showMsgList()
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
		}

		public function showMsgDetail($id)
		{
			$results = DB::table('msg_reply')
		               ->select( 'REPLY_MESSAGE', 'REPLY_TIME', 'msg_reply.PERSON_NO' , 'msg_list.MSG_TITLE') 
		               ->leftjoin('msg_list', 'msg_reply.MSG_NO' , '=', 'msg_list.MSG_NO')
		               ->where('msg_reply.MSG_NO', '=', $id)
		               ->get(); 
		  
		  if ($id=="add") {
		    $add_title = ["foo" => "bar"];
		    return View::make('msg_reply')->with(compact("results", "add_title") );
		  } else {
		    return View::make('msg_reply')->with(compact("results"));
		  }
		}


		public function replyMsg($id)
		{
			if ($id == "add") {
			    
			    if ( Input::has('MSG_TITLE') && Input::has('REPLY_MESSAGE')  ) {
			      $msg_title = Input::get('MSG_TITLE');

			      //get last MSG_NO
			      $results = DB::table('msg_list')
			                   ->select('MSG_NO')
			                   ->orderBy('MSG_NO', 'desc')->first();
			      if ($results) 
			        $msg_no = $results->MSG_NO +1;
			      else 
			        $msg_no = 1;

			      DB::table('msg_list')
			        ->insert( array('MSG_TITLE' => $msg_title ,
			                        
			                        'PERSON_NO' => '1' ,
			                        'MSG_TIME' => date("Y-m-d H:i:s")
			                        ) 
			                );
			    
			      $reply_message = Input::get('REPLY_MESSAGE');
			      DB::table('msg_reply')
			        ->insert( array('REPLY_MESSAGE' => $reply_message ,
			                        'MSG_NO' => $msg_no ,
			                        'PERSON_NO' => '1' ,
			                        'REPLY_TIME' => date("Y-m-d H:i:s")
			                        ) 
			                );
			    }

			    $msg = "發文成功";
			    return Redirect::to('/msg/'.$msg_no)->with(compact("msg"));  

			} else {


			  if ( Input::has('REPLY_MESSAGE')  ) {
			    $reply_message = Input::get('REPLY_MESSAGE');
			    
			    DB::table('msg_reply')
			      ->insert( array('REPLY_MESSAGE' => $reply_message ,
			      	              'MSG_NO' => $id ,
			      	              'PERSON_NO' => '1' ,
			      	              'REPLY_TIME' => date("Y-m-d H:i:s")
			      	              ) 
			      				);
			    $msg = "回覆成功";

			  } else {
			    $msg = "請輸入標題及訊息內容";
			  }

			  $results = DB::table('msg_reply')
			               ->select( 'REPLY_MESSAGE', 'REPLY_TIME', 'msg_reply.PERSON_NO' , 'msg_list.MSG_TITLE') 
			               ->leftjoin('msg_list', 'msg_reply.MSG_NO' , '=', 'msg_list.MSG_NO')
			               ->get(); 

			  // return View::make('msg_reply')->with( compact("results") );
			  return Redirect::to('/msg/'.$id)->with(compact("msg"));        
			}     
		}

}

