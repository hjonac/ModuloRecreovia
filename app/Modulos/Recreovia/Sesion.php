<?php

namespace App\Modulos\Recreovia;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class Sesion extends Model
{
	protected $table = 'Sesion';
    protected $primaryKey = 'Id';
    protected $connection = 'mysql';

    public function cronograma()
    {
    	return $this->belongsTo('App\Modulos\Recreovia\Cronograma', 'Id_Cronograma');
    }

    public function profesor()
    {
    	return $this->belongsTo('App\Modulos\Recreovia\Recreopersona', 'Id_Recreopersona');
    }
}