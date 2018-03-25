<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConstraintsListaValorTablaYTablaMovimientos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('lista_valor') && Schema::hasTable('movimientos') ) {
            Schema::table('movimientos', function(Blueprint $table){
             $table->integer('tipo_movimiento_id')->unsigned()->change();   
             $table->integer('tipo_transaccion_id')->unsigned()->change();   
             //$table->integer('detalle_movimiento_id')->unsigned()->change();   
             $table->foreign('tipo_movimiento_id')->references('id')->on('lista_valor');
             $table->foreign('tipo_transaccion_id')->references('id')->on('lista_valor');
             //$table->foreign('detalle_movimiento_id')->references('id')->on('lista_valor');
             
            }   );
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('lista_valor');
    }
}
