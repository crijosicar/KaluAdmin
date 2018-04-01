<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConversationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('conversaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')
                    ->references('id')
                    ->on('users');
            $table->string('mensaje');
            $table->date('fecha_creacion');
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
        Schema::drop('conversaciones');
    }
}
