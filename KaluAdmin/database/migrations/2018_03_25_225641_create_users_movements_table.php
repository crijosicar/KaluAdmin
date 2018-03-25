<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('user_movimientos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')
                    ->references('id')
                    ->on('users');
            $table->integer('movimiento_id')
                    ->references('id')
                    ->on('movimientos');
            $table->softDeletes();
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
        //
        Schema::drop('user_movimientos');
    }
}
