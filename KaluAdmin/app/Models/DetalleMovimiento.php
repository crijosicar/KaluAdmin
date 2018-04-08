<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id [TYPE=INTEGER, NULLABLE=0, DEFAULT=""]
 * @property integer $categoria_activo_id [TYPE=INTEGER, NULLABLE=0, DEFAULT=""]
 * @property integer $movimiento_id [TYPE=INTEGER, NULLABLE=0, DEFAULT=""]
 * @property string $nombre_activo [TYPE=STRING, NULLABLE=0, DEFAULT=""]
 * @property int $monto [TYPE=BIGINT, NULLABLE=0, DEFAULT=""]
 * @property string $deleted_at [TYPE=DATETIME, NULLABLE=1, DEFAULT=""]
 * @property string $created_at [TYPE=DATETIME, NULLABLE=1, DEFAULT=""]
 * @property string $updated_at [TYPE=DATETIME, NULLABLE=1, DEFAULT=""]
 */
class DetalleMovimiento extends Model
{
	// Attributes.
	protected $table = 'detalle_movimiento';
	
        protected $fillable = ['categoria_activo_id', 'movimiento_id', 'nombre_activo', 'monto'	];
	
        protected $guarded = ['id'];
	
        protected $hidden = [ 'created_at', 'updated_at', 'deleted_at' ];
	/* ---- Everything after this line will be preserved. ---- */
}
