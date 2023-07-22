<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Hallazgo extends Model
{
    use HasFactory;


    // protected $encryptable = [
    //     'nombre',
    //     'tipo',
    //     'descripcion',
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

    public function proyecto()
    {
       // return $this->hasMany(User::class,'id');
        return $this->belongsTo(Proyecto::class);
    }


    public function diagnosticos()
    {
        //return $this->belongsTo(Proyecto::class,'id_user');
       return $this->hasMany(Diagnostico::class);
    }
}
