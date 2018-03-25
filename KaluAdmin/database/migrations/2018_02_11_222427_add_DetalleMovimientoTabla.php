<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDetalleMovimientoTabla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('detalle_movimiento', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('categoria_activo_id')
                    ->references('id')
                    ->on('lista_valor');
            $table->integer('movimiento_id')
                    ->references('id')
                    ->on('movimientos');
            $table->string('nombre_activo');
            $table->bigInteger('monto');
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
        Schema::drop('detalle_movimiento');
    }
}
