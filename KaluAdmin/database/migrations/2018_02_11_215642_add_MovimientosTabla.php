<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMovimientosTabla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('movimientos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tipo_movimiento_id');
            $table->integer('tipo_transaccion_id');
            $table->bigInteger('monto');
            $table->integer('detalle_movimiento_id');
            $table->date('fecha_movimiento');
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
        Schema::drop('movimientos');
    }
}
