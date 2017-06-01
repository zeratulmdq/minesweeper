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
    public function minesweeper() {
    	return $this->belongsTo(Minesweeper::class);
    }

    
}
