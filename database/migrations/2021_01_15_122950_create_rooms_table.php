<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('hab1')->nullable();
            $table->boolean('hab2')->nullable();
            $table->boolean('hab3')->nullable();
            $table->boolean('hab4')->nullable();
            $table->boolean('hab5')->nullable();
            $table->boolean('hab6')->nullable();
            $table->boolean('hab7')->nullable();
            $table->boolean('hab8')->nullable();
            $table->boolean('hab9')->nullable();
            $table->boolean('hab10')->nullable();
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
        Schema::dropIfExists('rooms');
    }
}
