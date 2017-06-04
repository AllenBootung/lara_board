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
	public $history = array() ;
	public $lock_area = array(); 
}

// cordingate
class Cord
{
	public $rowIndex;
	public $columnIndex;
}

class Game extends Controller
{
 
    
		//顯示列表
    public function showGame()
    {
    	
    	return View::make('game');
		}

		//check movement before save into history
		// public function checkHistory($move_direction, $safe)
		// {
		// 	$done = false;
  //     $step = $safe->history.end()


		// 	//check if enter lock area
		// 	for ($i=0; $i < $safe->lock_area.length(); $i++) { 
		// 			if ( $safe->lock_area[i] ) {
		// 					# code...
		// 			}	
		// 	}

		// 	//check this move in every history
		// 	for ($i=0; $i < $safe->history.length(); $i++) { 
		// 		# code...
		// 	}

		// 	return $done;
		// }

		

		//add this movement to safe route or delee
		// public function history($move, $safe)
		// {
		// 	$now = $safe->history.end();
		// 	switch ($move) {
		// 		case 0:
		// 			# code...
		// 			break;
		// 		case 1:
		// 			# code...
		// 			break;
		// 		case 2:
		// 			# code...
		// 			break;
		// 		case 3
		// 			# code...
		// 			break;
				
		// 		default:
		// 			# code...
		// 			break;
		// 	}
		// }

		// //safe route moving
		// public function move($safe)
		// {
		// 		$done = false;
		// 		do {
		// 	  	$move_direction = rand(0,3);
		// 	  	$go = $this->checkHistory($safe, $move_direction);
			  	
		// 	  	if ($go) {
		// 	  		$this->history($move_direction);
		// 	  		$done = true;
		// 	  	} 

				  
		// 		} while (!$done);

		// 		//if route repeat, go back

		// }

		//after safe route created, place enemy
		public function placeEnemies($safe)
		{
				//check if this enemy in range
				$done = false;
				do {

				} while (!$done);
		}

		// enemies.php?rowQuantity=7&columnQuantity=7&enemyQuantity=1 
		// public function showEnemy(Request $request)
		// {
			
		// 	$safe = new Safe();

		// 	$done = false;
		// 	do {
				
		// 	  $now_row = 0;
		// 	  $now_col = 0;
		// 	  $route = new Cord;
		// 	  $route->rowIndex = 0;
		// 	  $route->columnIndex = 0;
		// 	  $safe.push($route);	
		// 	  // $safe->history = [{"x": $now_col, "y": $now_row}];

		// 	  //move ↓1 ↑2 →3 ←4 untill (Quantity, Quantity)
		// 	  while ( ($now_row != $request->rowQuantity) && ($now_col != $request->colQuantity) ) {
		// 	  	$this->move($safe);
		// 	  }
				
		// 		//place enemies  
		// 	  for ($i=0; $i < $request->enemyQuantity; $i++) { 
		// 	  	$this->placeEnemies();
		// 	  }
				
		// 	} while (!$done);
		


		// 	// return enemies to front
		// 	$postition = (object) $save->history;

		// 	// $postition = (object) [ 'rowIndex'=>2, 'columnIndex'=>5 ];

		// 	// $postition = "[
		// 	// 						  { 'rowIndex': 2, 'columnIndex': 4},
		// 	// 						  { 'rowIndex': 2, 'columnIndex': 5}
		// 	// 						 ]";


		// 	$JSONpostion = json_encode($postition);
		// 	return $JSONpostion;
		// }



		public function showEnemy(Request $request)
		{
			
			$safe = new Safe();

				

			  $route = new Cord;
			  $route->rowIndex = 2;
			  $route->columnIndex = 2;

			  array_push($safe->history, $route);
			  
			  // $safe->history.push($route);	

			  $JSONpostion = json_encode($safe);
			  return $JSONpostion;
		}	









		// public function showEnemy(Request $request)
		// {
		// 	// $postition = ["foo" => "bar",
  //  //  								"bar" => "foo"];
		// 	// $postition = 
		// 	// 						 [
		// 	// 						  { 'rowIndex': 2, 'columnIndex': 4},
		// 	// 						  { 'rowIndex': 2, 'columnIndex': 5}
		// 	// 						 ];

		// 	$pos = new Cord();
		// 	$pos->rowIndex = 2;
		// 	$pos->columnIndex = 2;
		// 	// $ar[] = $pos;
		// 	$ar = array();
		// 	array_push($ar,$pos);
		// 	$JSONpos = json_encode($ar);
		// 	return $JSONpos;

		// 	// $JSONpostion = json_encode($postition);
		// 	// return $JSONpostion;
		// }
}

