<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class estados extends Model
{
    use HasFactory;


    // protected $encryptable = [
    //     'estado',
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

    public function etapa(){
        return $this->hasMany('App\Models\etapas');
    }
}
