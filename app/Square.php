<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Square extends Model
{
    protected $fillable = ['row', 'column', 'status', 'hasMine', 'neighbours'];

    protected $hidden = ['hasMine', 'created_at', 'updated_at'];

    protected $casts = [
		'hasMine' => 'integer',
		'neighbours' => 'integer'
	];

	/**
	 * Get the associated Game
	 * 
	 * @return Minesweeper
	 */
    public function minesweeper() 
    {
    	return $this->belongsTo(Minesweeper::class);
    }

    /**
     * Reveal the selected Square
     * 
     * @return this
     */
    public function reveal()
    {
    	$around = $this->minesweeper->squares->filter(function($neighbour) {
			return
				$neighbour->row >= $this->row - 1 && 
				$neighbour->row <= $this->row + 1 && 
				$neighbour->column >= $this->column - 1 && 
				$neighbour->column <= $this->column + 1 &&
				!($neighbour->column == $this->column && $neighbour->row == $this->row);
		});

		$this->neighbours = $around->reduce(function ($carry, $neighbour) {
		    return $carry + $neighbour->hasMine;
		});

		$this->status = 1;
		$this->save();

		return $around;
    }

    
}
