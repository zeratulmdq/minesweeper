<?php

Route::post('/games', 'GameController@store');

Route::get('/games/{minesweeper}', 'GameController@show');

Route::patch('/games/{minesweeper}/squares/{square}/reveal', 'GameController@reveal');