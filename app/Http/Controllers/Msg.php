<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models;
use App\Models\MsgReply;
use App\Models\MsgList;


use DB;
use View;
use Redirect;
class Msg extends Controller
{
    
		//顯示列表
    public function showMsgList()
    {
    	$results = DB::table('msg_lists')
    	             ->select( 'msg_lists.MSG_NO', 
    	             					 'MSG_TITLE',
    	             					 'msg_lists.created_at', 
    	             					 'msg_lists.PERSON_NO', 
    	             					 DB::raw('COUNT(msg_replies.REPLY_NO) as REPLY_COUNT'),
 														 DB::raw('MAX(msg_replies.created_at) as reply_created_at'),
 														 DB::raw('(SELECT REPLY_MESSAGE
 														 	          FROM msg_replies
 														 	         WHERE msg_lists.MSG_NO = msg_replies.MSG_NO
 														 	         LIMIT 1 )FIRST_MESSAGE
 														 				')  	 
    	             					)
    	             ->leftjoin('msg_replies', 'msg_lists.MSG_NO', '=', 'msg_replies.MSG_NO')
    	             ->groupBy('msg_lists.MSG_NO')
                   ->orderBy('msg_lists.MSG_NO')
    	             ->paginate(5)
    	             ;
                   
    	return View::make('msg_list')->with(compact("results"));
		}

		//列表編輯或刪除
		public function changeMsgList(Request $request)
		{

			//編輯
			if ( $request->has('SAVE_EDIT')  ) {
				$v = Validator::make($request->all(), [
				        'MSG_TITLE' => 'required'
				     ]);
				if ($v->fails()) {
				    return redirect()->back()->withErrors($v->errors());
				}
				
		    $msg_title = $request->input('MSG_TITLE');
		    $msg_no = $request->input('MSG_NO');
		
		    DB::table('msg_lists')
		      ->where('MSG_NO', $msg_no)
		      ->update( ['MSG_TITLE' => $msg_title]
		      				)
		      ;
				
		  } 

		  //刪除
	  	if ( $request->has('DEL_LIST')  ) {
	  		$v = Validator::make($request->all(), [
	  		        'MSG_NO' => 'required'
	  		     ]);
	  		if ($v->fails()) {
	  		    return redirect()->back()->withErrors($v->errors());
	  		}
	  		
  	    $msg_no = $request->input('MSG_NO');

  	    //刪除所有回應
  	    DB::table('msg_replies')
  	      ->where('MSG_NO', $msg_no)
  	      ->delete()
  	      ;

  			//刪除議題
  	    DB::table('msg_lists')
  	      ->where('MSG_NO', $msg_no)
  	      ->delete()
  	      ;
	  		
	    }

      //導向的分頁
      if ( $request->input("page") ){
      	$page = $request->input("page");
	    	return Redirect::to('/msg' .'?page='. $page);  
      } else {
	    	return Redirect::to('/msg');  
      }
		  
		}

		//留言版顯示
		public function showMsgDetail($id)
		{
			$results = DB::table('msg_replies')
		               ->select( 'msg_replies.REPLY_NO', 
		               					 'REPLY_MESSAGE', 
		               					 'msg_replies.created_at', 
		               					 'msg_replies.PERSON_NO' , 
		               					 'msg_lists.MSG_TITLE') 
		               ->leftjoin('msg_lists', 'msg_replies.MSG_NO' , '=', 'msg_lists.MSG_NO')
		               ->where('msg_replies.MSG_NO', '=', $id)
                   ->orderBy('msg_replies.REPLY_NO')
		               ->paginate(5); 
		  
		  if ($id=="add") { //當網址是/add時新增議題，於前端顯示title輸入框
		    $add_title = ["foo" => "bar"];
		    return View::make('msg_reply')->with(compact("results", "add_title") );
		  } else {
		    return View::make('msg_reply')->with(compact("results"));
		  }
		}

		//留言版 新增修改刪除
		public function replyMsg($id, Request $request)
		{
			
			//新發文
			if ($id == "add") {
			    $v = Validator::make($request->all(), [
			            'MSG_TITLE' => 'required',
			            'REPLY_MESSAGE' => 'required'
			         ]);
			    if ($v->fails()) {
			        return redirect()->back()->withErrors($v->errors());
			    }
			    
		      $msg_title = $request->input('MSG_TITLE');

		      //get last MSG_NO
		      $results = DB::table('msg_lists')
		                   ->select('MSG_NO')
		                   ->orderBy('MSG_NO', 'desc')->first();
		      if ($results) 
		        $msg_no = $results->MSG_NO +1;
		      else 
		        $msg_no = 1;

		      //新增標題
		      DB::table('msg_lists')
		        ->insert( ['MSG_TITLE' => $msg_title ,
		                   'PERSON_NO' => '1' ,
		                   'created_at' => date("Y-m-d H:i:s")
		                  ]
		                );
		    
		    	//新增回應
		      $reply_message = $request->input('REPLY_MESSAGE');
		      DB::table('msg_replies')
		        ->insert( ['REPLY_MESSAGE' => $reply_message ,
		                   'MSG_NO' => $msg_no ,
		                   'PERSON_NO' => '1' ,
		                   'created_at' => date("Y-m-d H:i:s")
		                  ] 
		                );

		    return Redirect::to('/msg/'.$msg_no)->with(compact("msg"));  

			} else {

				//新留言
				if ( $request->has('SAVE_ADD')  ) {
					$v = Validator::make($request->all(), [
					        'REPLY_MESSAGE' => 'required'
					     ]);
					if ($v->fails()) {
					    return redirect()->back()->withErrors($v->errors());
					}
				  
			    $reply_message = $request->input('REPLY_MESSAGE');
			    
			    DB::table('msg_replies')
			      ->insert( ['REPLY_MESSAGE' => $reply_message ,
			      	         'MSG_NO' => $id ,
			      	         'PERSON_NO' => '1' ,
			      	         'created_at' => date("Y-m-d H:i:s")
			      	        ] 
			      				);
			    $msg = "回覆成功";
				}

			  //修改留言
	  		if ( $request->has('SAVE_EDIT')  ) {
	  			$v = Validator::make($request->all(), [
	  			        'REPLY_MESSAGE' => 'required',
	  			        'REPLY_NO' => 'required'
	  			     ]);
	  			if ($v->fails()) {
	  			    return redirect()->back()->withErrors($v->errors());
	  			}
	  			
  		    $reply_message = $request->input('REPLY_MESSAGE');
  		    
  		    $reply_no = $request->input('REPLY_NO');
  		
  		    DB::table('msg_replies')
  		      ->where('REPLY_NO', $reply_no)
  		      ->update( ['REPLY_MESSAGE' => $reply_message,
  		      					 'created_at'	=> date("Y-m-d H:i:s")
  		      					]
  		      				)
  		      ;
	  			
	  	  } 

	  	  //刪除留言
	    	if ( $request->has('DEL_LIST')  ) {
	    		$v = Validator::make($request->all(), [
	    		        'REPLY_NO' => 'required'
	    		     ]);
	    		if ($v->fails()) {
	    		    return redirect()->back()->withErrors($v->errors());
	    		}
	    		if ( $request->has('REPLY_NO')  ) {
	    	    $reply_no = $request->input('REPLY_NO');
	    	    MsgReply::destroy($reply_no);
	    		}
	      } 

        //導向的分頁
        if ( $request->input("page") ){
        	$page = $request->input("page");
  	    	return Redirect::to('/msg/'. $id .'?page='. $page)->with(compact("msg"));  
        } else {
  	    	return Redirect::to('/msg/'. $id)->with(compact("msg"));  
        }

			  
			}     

			
		}

}

