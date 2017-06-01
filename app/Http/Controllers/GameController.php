<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\GameRequest;
use App\Minesweeper;
use App\Square;

class GameController extends Controller
{
	/**
	 * Return the requested Minesweeper instance
	 * with associated squares.
	 * 
	 * @param  Minesweeper $minesweeper 
	 * @return Minesweeper
	 */
	public function show(Minesweeper $minesweeper)
	{
		$minesweeper->squares;

		return $minesweeper;
	}

	/**
	 * Save a new Game instace
	 * 
	 * @param  GameRequest $request
	 * @return Minesweeper
	 */
    public function store(GameRequest $request) 
    {
    	DB::beginTransaction();
    	$minesweeper = Minesweeper::create($request->only(['columns', 'rows', 'mines']));
    	$minesweeper->createSquares();
    	$minesweeper->createMines();
    	$minesweeper->squares;
    	DB::commit();

    	return $minesweeper;
    }

    /**
     * Update selected game and associated squares
     * to a REVEAL event
     * 
     * @param  Minesweeper $minesweeper 
     * @param  Square      $square      
     * @return Minesweeper
     */
    public function reveal(Minesweeper $minesweeper, Square $square) 
    {
    	if($square->minesweeper != $minesweeper)
    		abort(422, "That square ain't a piece of your game");

    	if($minesweeper->over)
    		abort(403, "Game already over");

    	DB::beginTransaction();
    	if($square->hasMine)
    	{
    		$minesweeper->over = true;
    		$square->status = 1;
    	} 
    	else 
    	{
    		$square->reveal();
    	}

    	if(!$square->neighbours)
		{
			$square->around->each(function($n){
				if($n->status == 0)
					$n->reveal();
			});
		}

    	$minesweeper->hasWon();
    	$minesweeper->save();
    	$minesweeper->squares;
    	DB::commit();

		return $minesweeper;
    }
}
