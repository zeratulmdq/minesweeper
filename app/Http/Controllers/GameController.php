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
    
    public function reveal(Minesweeper $minesweeper, Square $square)
    {
    	
    }
}
