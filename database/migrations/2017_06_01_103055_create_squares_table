<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSquaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('squares', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('minesweeper_id')->unsigned();
            $table->integer('row');
            $table->integer('column');
            $table->integer('status')->default(0);
            $table->boolean('hasMine')->default(false);
            $table->integer('neighbours')->default(0);
            $table->timestamps();

            $table->foreign('minesweeper_id')->references('id')->on('minesweepers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('squares');
    }
}
