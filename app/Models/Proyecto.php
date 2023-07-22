<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

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
    

    // protected $encryptable = [
    //     'folio',
    //     'costo_final',
    //     'costo_aprox',
    //     'dinero_acuenta',
    //     'fecha_recibido',
    //     'fecha_entregado',
    //     'descripcion_problema',
    //     'tipo_servicio',
    // ];

    
    // public function setAttribute($key, $value)
    // {
    //     if (in_array($key, $this->encryptable)) {
    //         $this->attributes[$key] = Crypt::encryptString($value);
    //     } else {
    //         $this->attributes[$key] = $value;
    //     }
    // }

    // public function getAttribute($key)
    // {
    //     $value = parent::getAttribute($key);
    //     if (in_array($key, $this->encryptable)) {
    //         return Crypt::decryptString($value);
    //     } else {
    //         return $value;
    //     }
    // }

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
   
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
