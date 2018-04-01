<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id [TYPE=INTEGER, NULLABLE=0, DEFAULT=""]
 * @property integer $user_id [TYPE=INTEGER, NULLABLE=0, DEFAULT=""]
 * @property string $mensaje [TYPE=STRING, NULLABLE=0, DEFAULT=""]
 * @property string $fecha_creacion [TYPE=DATE, NULLABLE=0, DEFAULT=""]
 * @property string $deleted_at [TYPE=DATETIME, NULLABLE=1, DEFAULT=""]
 * @property string $created_at [TYPE=DATETIME, NULLABLE=1, DEFAULT=""]
 * @property string $updated_at [TYPE=DATETIME, NULLABLE=1, DEFAULT=""]
 */
class Conversaciones extends Model
{
	// Attributes.
	public $timestamps = false;
	protected $connection = 'mysql';
	protected $table = 'conversaciones';
	protected $fillable = ['user_id', 'mensaje', 'fecha_creacion'];
	protected $guarded = ['id'];
	
	/* ---- Everything after this line will be preserved. ---- */
}
