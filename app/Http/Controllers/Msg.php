<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Msg extends Controller
{
    
		public function index( ){
			// return "index";
			  //   Route::get('/{id?}', function ($id=123) {
					//     return $id;
					// });
			return view('welcome');
		}

    public function listt(){
    	
			return view(make('msg_list')
				     ->with('comments', $comments); 
		}

		public function reply(){
			return view('msg_reply');
		}

}

