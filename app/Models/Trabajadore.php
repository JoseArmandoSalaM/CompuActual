<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajadore extends Model
{
    use HasFactory;
    public function users()
    {
        return $this->hasOne(User::class);
    }


    public function proyectos()
    {
        //return $this->belongsTo(Proyecto::class,'id_user');
       return $this->hasMany(Proyecto::class,'trabajador_id');
    }
}
