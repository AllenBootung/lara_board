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

//enemy position
class Dangerous
{
  public $enemies = array();
  public $lock_area = array();
}

class Game extends Controller
{
		//顯示列表
    public function showGame()
    {
    	
    	return View::make('game');
		}

		//check movement before save into history
		public function checkHistory($safe, $move_direction)
		{
			$done = false;

      $step_into = clone end($safe->history);
      switch ($move_direction) {
      	case 0:
      		$step_into->rowIndex--;
      		break;
      	case 1:
      		$step_into->columnIndex++;
      		break;
      	case 2:
      		$step_into->rowIndex++;
      		break;
      	case 3:
      		$step_into->columnIndex--;
      		break;
      	default:
      		# code...
      		break;
      }

      //step out of map range
      if ( ($step_into->rowIndex < 0) || ($step_into->rowIndex > $safe->rowQuantity) ||
      		 ($step_into->columnIndex < 0) || ($step_into->columnIndex > $safe->columnQuantity)
       ) {
      	return false;
      }

			//check if step into lock area
			for ($i=0; $i < count($safe->lock_area); $i++) { 
					if ( ($safe->lock_area[$i]->rowIndex == $step_into->rowIndex) &&
						   ($safe->lock_area[$i]->columnIndex == $step_into->columnIndex) 
					 ) {
							return false;
					}	
			}

			//check if this repeat route
			for ($i=0; $i < count($safe->history); $i++) { 
					if ( ($safe->history[$i]->rowIndex == $step_into->rowIndex) &&
						   ($safe->history[$i]->columnIndex == $step_into->columnIndex) 
					 ) {
							return false;
					}	
			}

			return true;
		}

		//add this movement to safe route or delee
		public function history($safe, $move_direction)
		{
			$step_into = clone end($safe->history);
      switch ($move_direction) {
      	case 0:
      		$step_into->rowIndex--;
      		break;
      	case 1:
      		$step_into->columnIndex++;
      		break;
      	case 2:
      		$step_into->rowIndex++;
      		break;
      	case 3:
      		$step_into->columnIndex--;
      		break;
      	case 'go_back':
      		array_push($safe->lock_area, $step_into);
      		array_pop($safe->history);
      	default:
      		# code...
      		break;
      }

      array_push($safe->history, $step_into);
		}

		//safe route moving
		public function move($safe)
		{
				$safe;
				$done = false;
				$false_direction = 0;

				do {
			  	$move_direction = rand(0,3);
			  	$go = $this->checkHistory($safe, $move_direction);
			  	
			  	if ($go) {
			  		$this->history($safe, $move_direction);
			  		$done = true;
			  	} else {
			  		$move_direction = ($move_direction+1) % 4;
			  		$false_direction++;
			  	}

			  	if ($false_direction>=4) {
			  		$this->history($safe, "go_back");
			  	}

				  $done = true;
				} while (!$done) ;


					  // for ($i=1; $i < 4; $i++) { 
					  // 	$arr[$i] = new Cord;
					  // 	$arr[$i]->rowIndex = $i;
					  // 	$arr[$i]->columnIndex = $i;
					  // 	array_push($safe->history, $arr[$i]);
					  // }

					  // 	$end = clone end($safe->history);
					  // 	$end->rowIndex = 88;
					  // 	array_push($safe->history, $end);

		}

		//after safe route created, place enemy
		public function placeEnemy($safe, $enemy_area)
		{
				$done = false;

        //create enemy
        $enemy_burn = new Cord();
        $enemy_burn->rowIndex = rand(0, $safe->rowQuantity-1);
        $enemy_burn->columnIndex = rand(0, $safe->columnQuantity-1);

        //check if co-worker taken this place
        do {
          if (condition) {
            # code...
          }
        } while (!$done);

        //check if this enemy on the way
				do {

				} while (!$done);

        return $sum;
		}

		// enemies.php?rowQuantity=7&columnQuantity=7&enemyQuantity=1 
		public function showEnemy(Request $request)
		{
			
			$safe = new Safe();
			$safe->columnQuantity = $request->columnQuantity;
			$safe->rowQuantity = $request->rowQuantity;

			$done = true;
			do {
			  
			  $route = new Cord;
			  $route->rowIndex = 0;
			  $route->columnIndex = 0;
			  $safe->history = [];
			  array_push($safe->history, $route);

			  //move ↑0 →1 ↓2 ←3 untill (Quantity, Quantity)
			  do {
			  	$this->move($safe);
			  	$now = clone end($safe->history);
			  	$now_col = $now->columnIndex;
			  	$now_row = $now->rowIndex;
			  	// $now_col =clone end($safe->history->columnIndex);
			  	// $now_row =clone end($safe->history->rowIndex);
			  } while ( 
			  				  ($now_row != $safe->rowQuantity) ||
			  	        ($now_col != $safe->columnQuantity)
			    );
				
        // expand safe area before place enemies
        $enemy_area = new Dangerous();
        foreach ($safe->history as $key => $value) {
          array_push($enemy_area->lock_area, $safe->history[$key]);

          //expand, check map range
          //4 directions
          if ( ($safe->history[$key]->rowIndex-1)>0 ) {
            $tmp = clone $safe->history[$key];
            $tmp->rowIndex--;
            array_push($enemy_area->lock_area, $tmp);
          } 
          if ( ($safe->history[$key]->columnIndex-1)>0 ) {
            $tmp = clone $safe->history[$key];
            $tmp->columnIndex--;
            array_push($enemy_area->lock_area, $tmp);
          }
          if ( ($safe->history[$key]->rowIndex+1) < $safe->rowQuantity ) {
            $tmp = clone $safe->history[$key];
            $tmp->rowIndex++;
            array_push($enemy_area->lock_area, $tmp);
          }
          if ( ($safe->history[$key]->columnIndex+1) < $safe->columnQuantity ) {
            $tmp = clone $safe->history[$key];
            $tmp->columnIndex++;
            array_push($enemy_area->lock_area, $tmp);
          }
        } //foreach ($safe->history as $key => $value)

				// place enemies  
        $enemy_sum = 0;
        do {
          $place = $this->placeEnemy($safe, $enemy_area);
          
          if ($place <= -1) {
            //$enemy_sum got -1 means too many enemies
            //not done, need to re route
            $done = false;
          } else {
            $enemy_sum++;
          }
        } while ( ($enemy_sum < $request->enemyQuantity) && ($place > -1) );

			 
				
			} while (!$done);
		


		// 	// return enemies to front
		// 	$postition = (object) $save->history;

		// 	// $postition = (object) [ 'rowIndex'=>2, 'columnIndex'=>5 ];

		// 	// $postition = "[
		// 	// 						  { 'rowIndex': 2, 'columnIndex': 4},
		// 	// 						  { 'rowIndex': 2, 'columnIndex': 5}
		// 	// 						 ]";


			$JSONpostion = json_encode($enemy_area->lock_area);
			return $JSONpostion;
		}//public function showEnemy(Request $request)



		// public function showEnemy(Request $request)
		// {
			
		// 	$safe = new Safe();

		// 	  // $route = new Cord;

		// 	  for ($i=0; $i < 3; $i++) { 
		// 	  	$arr[$i] = new Cord;
		// 	  	$arr[$i]->rowIndex = $i;
		// 	  	$arr[$i]->columnIndex = $i;
		// 	  	array_push($safe->history, $arr[$i]);
		// 	  }

		// 	  // $route->rowIndex = 2;
		// 	  // $route->columnIndex = 2;

		// 	  // $safe->history = $route;	
		// 	  // array_push($safe->history, $route);

			


		// 	  $JSONpostion = json_encode($safe);
		// 	  return $JSONpostion;
		// }	






}//class Game extends Controller

