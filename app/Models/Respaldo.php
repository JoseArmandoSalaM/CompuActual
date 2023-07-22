<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Respaldo extends Model
{
    use HasFactory;

    // protected $encryptable = [
    //     'ruta_carpetas',
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
}
