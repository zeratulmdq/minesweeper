<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Minesweeper extends Model
{
    protected $fillable = ['columns', 'rows', 'mines'];

    /**
     * Get all associated squares
     * 
     * @return Collection(Square)
     */
    public function squares() 
    {
    	return $this->hasMany(Square::class);
    }

    /**
     * Get number of squares to reveal
     * to win the game
     * 
     * @return int
     */
    public function squaresToReveal()
    {
    	return $this->columns * $this->rows - $this->mines;
    }

    /**
     * Get revealed squares.
     * 
     * @return int
     */
    public function revealedSquares()
    {
    	return $this->squares->reduce(function($carry, $square){
    		return $carry + $square->status;
    	});
    }

    /**
     * Create squares according to
     * minesweeper size.
     * 
     * @return this
     */
    public function createSquares()
    {
    	$squares = collect();

    	for($r = 0; $r < $this->rows; $r++) {
    		for($c = 0; $c < $this->columns; $c++) {
    			$squares->push(new Square(['column' => $c, 'row' => $r, 'status' => 0]));
    		}
    	}

    	$this->squares()->saveMany($squares);

        return $this;
    }

    /**
     * Check if the user won
     * 
     * @return boolean
     */
    public function hasWon()
    {
    	if(!$this->over && $this->revealedSquares() == $this->squaresToReveal()) 
    		$this->won = true;
    }

    /**
     * Create mines in random squares
     * 
     * @return this
     */
    public function createMines()
    {
    	$assignedMines = 0;

    	while($assignedMines < $this->mines)
    	{
    		$col = mt_rand(0, $this->columns - 1);
    		$row = mt_rand(0, $this->rows - 1);

    		$item = $this->squares->first(function ($value) use ($row, $col) {
			    return $value->column == $col && $value->row == $row;
			});

    		if(!$item->hasMine)
    		{
    			$item->hasMine = true;
    			$item->save();
    			$assignedMines++;
    		}
    	}

        return $this;
    }
}
