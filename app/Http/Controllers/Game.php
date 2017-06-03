<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

use DB;
use View;
use Redirect;

// game safe route
class Safe 
{
	public $history = array();
	public $lock = array();
}

class Game extends Controller
{
 
    
		//顯示列表
    public function showGame()
    {
    	
    	return View::make('game');
		}

		//check movement before step into history
		public function checkHistory($move_direction, $safe)
		{
			//check if enter lock area
			for ($i=0; $i < $safe->lock.length(); $i++) { 
				
			}

			//check this move in every history
			for ($i=0; $i < $safe->history.length(); $i++) { 
				# code...
			}
		}

		

		//add this movement to safe route
		public function history($move, $safe)
		{
			$now = $safe->history.end();
			switch ($move) {
				case 1:
					# code...
					break;
				case 2:
					# code...
					break;
				case 3:
					# code...
					break;
				case 4:
					# code...
					break;
				case 'back_n_block':
					//delee latest postion and lock it
					$safe->lock = $safe->history.end();
					unset( $safe->history.end());
					break;
				default:
					# code...
					break;
			}
		}

		//safe route moving
		public function move($safe)
		{
				$done = false;
				do {
			  	$move_direction = rand() % 4;

			  	$go = checkHistory($move_direction);
			  	
			  	if ($go) {
			  		history($move_direction);
			  	} else {
			  		history("back_n_block");
			  	}

				  
				} while ( $done ) 

				//if route repeat, go back

		}

		//after safe route created, place enemy
		public function placeEnemies($safe)
		{
				//check if this enemy in range
				$done = false;
				do {

				} while ($done);
		}

		public function showEnemy(Request $request)
		{
			// enemies.php?rowQuantity=7&columnQuantity=7&enemyQuantity=1 
			$safe = new Safe();

			$done = false;
			do {
				// 1.safe route
			  $now_row = 0;
			  $now_col = 0;

			  $safe->history = [{"x": $now_col, "y": $now_row}];

			  //move ↓1 ↑2 →3 ←4 untill (Quantity, Quantity)
			  //if exist history move_direction++
			  while ( ($now_row != $request->rowQuantity) && ($now_col != $request->colQuantity) ) {
			  	$this->move();
			  }
				  
			  for ($i=0; $i < $request->enemyQuantity; $i++) { 
			  	placeEnemies();
			  }
				
			} while ($done);
		


			// return enemies to front
			$postition = (object) $save->history;

			// $postition = (object) [ 'rowIndex'=>2, 'columnIndex'=>5 ];

			// $postition = "[
			// 						  { 'rowIndex': 2, 'columnIndex': 4},
			// 						  { 'rowIndex': 2, 'columnIndex': 5}
			// 						 ]";


			$JSONpostion = json_encode($postition);
			return $JSONpostion;
		}
}

