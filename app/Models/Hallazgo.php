<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hallazgo extends Model
{
    use HasFactory;

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
