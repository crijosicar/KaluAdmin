<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id [TYPE=INTEGER, NULLABLE=0, DEFAULT=""]
 * @property integer $user_id [TYPE=INTEGER, NULLABLE=0, DEFAULT=""]
 * @property integer $movimiento_id [TYPE=INTEGER, NULLABLE=0, DEFAULT=""]
 * @property string $deleted_at [TYPE=DATETIME, NULLABLE=1, DEFAULT=""]
 * @property string $created_at [TYPE=DATETIME, NULLABLE=1, DEFAULT=""]
 * @property string $updated_at [TYPE=DATETIME, NULLABLE=1, DEFAULT=""]
 */
class UserMovimientos extends Model
{
	// Attributes.
	protected $table = 'user_movimientos';

        protected $fillable = ['user_id', 'movimiento_id'];

        protected $guarded = ['id'];

        protected $hidden = [ 'created_at', 'updated_at', 'deleted_at' ];

}
