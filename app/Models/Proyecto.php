<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Proyecto
 *
 * @property $id
 * @property $folio
 * @property $CostoFinal
 * @property $CostoAprox
 * @property $FechaRecibido
 * @property $FechaEntregado
 * @property $DineroAcuenta
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Proyecto extends Model
{
    
    static $rules = [
		'folio' => 'required',
		'CostoFinal' => 'required',
		'CostoAprox' => 'required',
		'FechaRecibido' => 'required',
		'FechaEntregado' => 'required',
		'DineroAcuenta' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['folio','CostoFinal','CostoAprox','FechaRecibido','FechaEntregado','DineroAcuenta'];

    public function etapa()
    {
       // return $this->hasMany(User::class,'id');
        return $this->belongsTo(etapas::class);
    }

    public function reparaciones()
    {
       // return $this->hasMany(User::class,'id');
        return $this->hasMany(Reparacion::class);
    }


    public function cliente()
    {
       // return $this->hasMany(User::class,'id');
        return $this->belongsTo(Cliente::class);

    }


    public function hallazgos()
    {
        //return $this->belongsTo(Proyecto::class,'id_user');
       return $this->hasMany(Hallazgo::class);
    }

    public function trabajador()
    {
       // return $this->hasMany(User::class,'id');
        return $this->belongsTo(Trabajadore::class);
    }
/*
    public function etapa()
    {
       // return $this->hasMany(User::class,'id');
        return $this->belongsTo(Etapa::class);
    }

    public function etapaM(){
        return $this->belongsToMany(Etapa::class);
    }
*/

    //Tabla Equipo 
    public function equipo()
    {
        return $this->hasOne(Equipo::class);
    }

    //Tabla Respaldo 
    public function respaldo()
    {
        return $this->hasOne(Respaldo::class);
    }

    public function diagnosticos()
    {
        return $this->belongsToMany(Diagnostico::class, 'diagnostico_proyecto');
    }


}
