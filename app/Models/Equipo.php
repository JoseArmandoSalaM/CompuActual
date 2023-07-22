<?php

namespace App\Models;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Equipo
 *
 * @property $id
 * @property $NombreEquipo
 * @property $CaracteristicasReales
 * @property $CaracteristicasPosibles
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Equipo extends Model
{
//   protected $encryptable = [
//     'nombre',
//     'caracteristicas_posibles',
//     'caracteristicas_reales',
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


    static $rules = [
		'NombreEquipo' => 'required',
		'CaracteristicasReales' => 'required',
		'CaracteristicasPosibles' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['NombreEquipo','CaracteristicasReales','CaracteristicasPosibles'];


    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }



}
