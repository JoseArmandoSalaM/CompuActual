<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Trabajadore extends Model
{
    use HasFactory;


    // protected $encryptable = [
    //     'direccion',
    //     'telefono',
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function proyectos()
    {
        //return $this->belongsTo(Proyecto::class,'id_user');
       return $this->hasMany(Proyecto::class,'trabajador_id');
    }
}
