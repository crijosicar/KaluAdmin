<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id [TYPE=INTEGER, NULLABLE=0, DEFAULT=""]
 * @property integer $tipo_movimiento_id [TYPE=INTEGER, NULLABLE=0, DEFAULT=""]
 * @property integer $tipo_transaccion_id [TYPE=INTEGER, NULLABLE=0, DEFAULT=""]
 * @property int $monto [TYPE=BIGINT, NULLABLE=0, DEFAULT=""]
 * @property integer $detalle_movimiento_id [TYPE=INTEGER, NULLABLE=0, DEFAULT=""]
 * @property string $fecha_movimiento [TYPE=DATE, NULLABLE=0, DEFAULT=""]
 * @property string $deleted_at [TYPE=DATETIME, NULLABLE=1, DEFAULT=""]
 * @property string $created_at [TYPE=DATETIME, NULLABLE=1, DEFAULT=""]
 * @property string $updated_at [TYPE=DATETIME, NULLABLE=1, DEFAULT=""]
 */
class Movimientos extends Model
{
	// Attributes.
	protected $table = 'movimientos';
	
        protected $fillable = ['tipo_movimiento_id', 'tipo_transaccion_id', 'monto', 'detalle_movimiento_id', 'fecha_movimiento' ];
	
        protected $guarded = ['id'];
	
        protected $hidden = [ 'created_at', 'updated_at', 'deleted_at' ];

        
}
