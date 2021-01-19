<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('startDate');
            $table->date('endDate');
            $table->unsignedBigInteger('user_id');//relacion con tabla users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');//clave ajena relacionada con tabla users
            $table->unsignedBigInteger('room_id');//relacion con tabla users
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');//clave ajena relacionada con tabla rooms
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
        Schema::dropIfExists('rents');
    }
}
