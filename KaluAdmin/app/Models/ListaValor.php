<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id [TYPE=INTEGER, NULLABLE=0, DEFAULT=""]
 * @property string $categoria [TYPE=STRING, NULLABLE=0, DEFAULT=""]
 * @property string $valor [TYPE=STRING, NULLABLE=0, DEFAULT=""]
 * @property string $deleted_at [TYPE=DATETIME, NULLABLE=1, DEFAULT=""]
 * @property string $created_at [TYPE=DATETIME, NULLABLE=1, DEFAULT=""]
 * @property string $updated_at [TYPE=DATETIME, NULLABLE=1, DEFAULT=""]
 */
class ListaValor extends Model
{
	// Attributes.
	protected $table = 'lista_valor';
	
        protected $fillable = ['categoria', 'valor'];
	
        protected $guarded = ['id'];
	
        protected $hidden = [ 'created_at', 'updated_at', 'deleted_at' ];
	/* ---- Everything after this line will be preserved. ---- */
}
