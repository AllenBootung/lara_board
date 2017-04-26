<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Firsthi extends Controller
{
    
		public function index( ){
			// return "index";
			  //   Route::get('/{id?}', function ($id=123) {
					//     return $id;
					// });
			return view('welcome');
		}

    public function post( ){
			return "posting";
		}

		public function postid( ){
			return "postingid";
		}

}
