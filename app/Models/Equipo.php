<?php

namespace App\Models;

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
