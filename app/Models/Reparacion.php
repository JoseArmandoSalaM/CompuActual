<?php

namespace App\Models;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Reparacion
 *
 * @property $id
 * @property $image
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Reparacion extends Model
{
    
    static $rules = [
    ];

    // protected $encryptable = [
    //     'image',
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
    protected $fillable = ['image'];



}
