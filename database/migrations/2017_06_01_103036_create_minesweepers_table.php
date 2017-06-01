<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMinesweepersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('minesweepers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('columns')->unsigned();
            $table->integer('rows')->unsigned();
            $table->integer('mines')->unsigned();
            $table->boolean('over')->default(false);
            $table->boolean('won')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('minesweepers');
    }
}
