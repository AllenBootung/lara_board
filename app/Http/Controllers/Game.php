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
  public $map = array();
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
      		$step_into->rowIndex++;
      		break;
      	case 1:
      		$step_into->columnIndex++;
      		break;
      	case 2:
      		$step_into->rowIndex--;
      		break;
      	case 3:
      		$step_into->columnIndex--;
      		break;
      	default:
      		# code...
      		break;
      }

      //step out of map range
      if ( ($step_into->rowIndex < 0) || ($step_into->rowIndex >= $safe->rowQuantity) ||
      		 ($step_into->columnIndex < 0) || ($step_into->columnIndex >= $safe->columnQuantity)
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
      $pushin = true;
			$step_into = clone end($safe->history);
      switch ($move_direction) {
      	case 0:
      		$step_into->rowIndex++;
      		break;
      	case 1:
      		$step_into->columnIndex++;
      		break;
      	case 2:
      		$step_into->rowIndex--;
      		break;
      	case 3:
      		$step_into->columnIndex--;
      		break;
      	case 'go_back':
      		array_push($safe->lock_area, $step_into);
      		array_pop($safe->history);
          $pushin = false;
          break;
      	default:
      		# code...
      		break;
      }

      $pushin && array_push($safe->history, $step_into);
		}

		//safe route moving
		public function move($safe)
		{
				$done = false;
				$false_direction = 0;

				do {

        //   //adjust go back rate
        //   if ( ( end($safe->history)->rowIndex%3) == 1) {
        //     $move_direction = rand(0,2);
        //     ($move_direction==2) && ($move_direction = 3);//go left

        //   } elseif ( ( end($safe->history)->columnIndex%3) == 1) {
        //     $move_direction = rand(0,2);

        //   } else {
			  	  // $move_direction = rand(0,1);
        //   }

          $move_direction = rand(0,1);
			  	$go = $this->checkHistory($safe, $move_direction);
			  	
			  	if ($go) {
			  		$this->history($safe, $move_direction);
			  		$done = true;
			  	} else {
			  		$move_direction = ($move_direction+1) % 2;
			  		$false_direction++;
			  	}

			  	if ($false_direction>3) {
			  		$this->history($safe, "go_back");
			  	}
				  
				} while (!$done) ;
		}

		// //after safe route created, place enemy
		public function placeEnemy($enemy_area, &$usable_map_cord)
		{
        //create enemy
			  //pick space from avalible map
        if (count($usable_map_cord)<1) {
        	return false;
        } else{
	        $seat = rand(0, count($usable_map_cord)-1);

	        array_push($enemy_area->enemies,  $enemy_area->map[ $usable_map_cord[$seat] ] ) ;
	        unset($usable_map_cord[$seat]);
	        $usable_map_cord2= array_values($usable_map_cord);
          $usable_map_cord = $usable_map_cord2;
        	return true;
	      }

		}

		// enemies/rowQuantity/7/columnQuantity/7/enemyQuantity/1 
		public function showEnemy(Request $request)
		{
      $v = Validator::make($request->all(), [
              'rowQuantity' => 'required|min:1',
              'columnQuantity' => 'required|min:1',
              'enemyQuantity' => 'required|min:0'
          ]);
      // if ($v->fails()) {
      //     return redirect()->back()->withErrors($v->errors());
      // }
			
			$safe = new Safe();
			$safe->columnQuantity = $request->columnQuantity;
			$safe->rowQuantity = $request->rowQuantity;

			$done = true;
			$route = new Cord;
			do {
			  
			  $route->rowIndex = 0;
			  $route->columnIndex = 0;
			  $safe->history = [];
        $safe->lock_area = [];
			  array_push($safe->history, $route);

			  //move untill (Quantity, Quantity)
			  do {
			  	$this->move($safe);
			  	$now = clone end($safe->history);
			  	$now_col = $now->columnIndex;
			  	$now_row = $now->rowIndex;
			  	
			  } while ( 
	  				  ($now_row != $safe->rowQuantity-1) ||
	  	        ($now_col != $safe->columnQuantity-1)
			    );
				

			  //build map
        $enemy_area = new Dangerous();
        $arr_map = [];
			  for ($i=0; $i < $request->rowQuantity; $i++) { 
			  	for ($j=0; $j < $request->columnQuantity; $j++) { 
			  		$arr_map[$i][$j] = 0;
			  		$tmp = new Cord();
			  		$tmp->rowIndex = $i;
			  		$tmp->columnIndex = $j;
			  		array_push($enemy_area->map, clone $tmp);
			  	}
			  }

        // expand safe area before place enemies
        foreach ($safe->history as $key => $value) {
          $arr_map[$safe->history[$key]->rowIndex][$safe->history[$key]->columnIndex] = -1;

          //expand, check map range in 4 directions
          if ( ($safe->history[$key]->rowIndex-1)>=0 ) {
            $arr_map[$safe->history[$key]->rowIndex-1][$safe->history[$key]->columnIndex] = -1;
          } 
          if ( ($safe->history[$key]->columnIndex-1)>=0 ) {
            $arr_map[$safe->history[$key]->rowIndex][$safe->history[$key]->columnIndex-1] = -1;
          }
          if ( ($safe->history[$key]->rowIndex+1) < $safe->rowQuantity ) {
            $arr_map[$safe->history[$key]->rowIndex+1][$safe->history[$key]->columnIndex] = -1;
          }
          if ( ($safe->history[$key]->columnIndex+1) < $safe->columnQuantity ) {
            $arr_map[$safe->history[$key]->rowIndex][$safe->history[$key]->columnIndex+1] = -1;
          }
        } //foreach ($safe->history as $key => $value)

        //list avalible enemy place
        $usable_map_cord = [];
        $cnt = 0;
        for ($i=0; $i < $request->rowQuantity; $i++) { 
			  	for ($j=0; $j < $request->columnQuantity; $j++) { 
			  		if ($arr_map[$i][$j] != (-1) ){
			  			array_push($usable_map_cord, $cnt);
			  		}

			  		$cnt++;
			  	}
			  }

				// place enemies  
        $enemy_sum = 0;
        do {
          $place = $this->placeEnemy($enemy_area, $usable_map_cord);
          
          if (!$place) {
            //dont have enough space
            $done = false;
          } else {
            $enemy_sum++;
          }
        } while ( ($enemy_sum < $request->enemyQuantity) && ($place) );
			 
			} while (!$done  );
			$JSONpostion = json_encode($enemy_area->enemies);
			return $JSONpostion;
		}//public function showEnemy(Request $request)
}//class Game extends Controller

