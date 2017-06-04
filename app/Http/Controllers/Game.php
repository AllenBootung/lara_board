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

	public $rowQuantity;
	public $columnQuantity;
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
		// public function checkHistory($safe, $move_direction)
		// {
		// 	$done = false;

  //     $step_into = $safe->history.end();
  //     switch ($move_direction) {
  //     	case 0:
  //     		$step_into->rowIndex-1;
  //     		break;
  //     	case 1:
  //     		$step_into->columnIndex+1;
  //     		break;
  //     	case 2:
  //     		$step_into->rowIndex+1;
  //     		break;
  //     	case 3:
  //     		$step_into->columnIndex-1;
  //     		break;
  //     	default:
  //     		# code...
  //     		break;
  //     }

  //     //step out of range
  //     if ( ($step_into->rowIndex < 0) || ($step_into->rowIndex > $safe->rowQuantity) ||
  //     		 ($step_into->columnIndex < 0) || ($step_into->columnIndex > $safe->columnQuantity)
  //      ) {
  //     	return false;
  //     }

		// 	//check if enter lock area
		// 	for ($i=0; $i < $safe->lock_area.length(); $i++) { 
		// 			if ( ($safe->lock_area[i]->rowIndex == $step_into->rowIndex) &&
		// 				   ($safe->lock_area[i]->columnIndex == $step_into->columnIndex) 
		// 			 ) {
		// 					return false;
		// 			}	
		// 	}

		// 	//check this move in every history
		// 	for ($i=0; $i < $safe->history.length(); $i++) { 
		// 			if ( ($safe->history[i]->rowIndex == $step_into->rowIndex) &&
		// 				   ($safe->history[i]->columnIndex == $step_into->columnIndex) 
		// 			 ) {
		// 					return false;
		// 			}	
		// 	}

		// 	return true;
		// }

		

		//add this movement to safe route or delee
		public function history($safe, $move)
		{
			// $now = $safe->history.end();
			// switch ($move) {
			// 	case 0:
			// 		# code...
			// 		break;
			// 	case 1:
			// 		# code...
			// 		break;
			// 	case 2:
			// 		# code...
			// 		break;
			// 	case 3
			// 		# code...
			// 		break;
				
			// 	default:
			// 		# code...
			// 		break;
			// }
		}

		//safe route moving
		// public function move($safe)
		// {
		// 		$done = false;
		// 		$false_direction = 0;

		// 		do {
		// 	  	$move_direction = rand(0,3);
		// 	  	$go = $this->checkHistory($safe, $move_direction);
			  	
		// 	  	if ($go) {
		// 	  		$this->history($move_direction);
		// 	  		$done = true;
		// 	  	} else{
		// 	  		$move_direction = ($move_direction+1) % 4;
		// 	  		$false_direction++;
		// 	  	}

		// 	  	if ($false_direction>=4) {
		// 	  		$this->history("go_back");
		// 	  	}

				  
		// 		} while (!$done) ;


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
		// 	$safe->columnQuantity = $request->columnQuantity;
		// 	$safe->rowQuantity = $request->rowQuantity;

		// 	$done = false;
		// 	do {
			  
		// 	  $route = new Cord;
		// 	  $route->rowIndex = 0;
		// 	  $route->columnIndex = 0;
		// 	  $safe->history[] = $route;
			  

		// 	  //move ↓1 ↑2 →3 ←4 untill (Quantity, Quantity)
		// 	  // while ( ($now_row != $request->rowQuantity) && ($now_col != $request->colQuantity) ) {
		// 	  	$this->move($safe);
		// 	  // }
				
		// 		//place enemies  
		// 	  // for ($i=0; $i < $request->enemyQuantity; $i++) { 
		// 	  // 	$this->placeEnemies();
		// 	  // }
				
		// 		$done = true;
		// 	} while (!$done);
		


		// // 	// return enemies to front
		// // 	$postition = (object) $save->history;

		// // 	// $postition = (object) [ 'rowIndex'=>2, 'columnIndex'=>5 ];

		// // 	// $postition = "[
		// // 	// 						  { 'rowIndex': 2, 'columnIndex': 4},
		// // 	// 						  { 'rowIndex': 2, 'columnIndex': 5}
		// // 	// 						 ]";


		// 	$JSONpostion = json_encode($safe);
		// 	return $JSONpostion;
		// }



		public function showEnemy(Request $request)
		{
			
			$safe = new Safe();

				

			  // $route = new Cord;

			  for ($i=0; $i < 3; $i++) { 
			  	$arr[$i] = new Cord;
			  	$arr[$i]->rowIndex = $i;
			  	$arr[$i]->columnIndex = $i;
			  	array_push($safe->history, $arr[$i]);
			  }

			  // $route->rowIndex = 2;
			  // $route->columnIndex = 2;

			  // $safe->history = $route;	
			  // array_push($safe->history, $route);

			  // $route->rowIndex = 2;
			  // $route->columnIndex = 3;
			  // array_push($safe->history, $route);


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
