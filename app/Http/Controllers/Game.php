<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

use DB;
use View;
use Redirect;
class Game extends Controller
{
 
    
		//顯示列表
    public function showGame()
    {
    	
    	return View::make('game');
		}

		public function enemy()
		{
			return "hi";
		}
}

