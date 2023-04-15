<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function proyectos()
    {
        //return $this->belongsTo(Proyecto::class,'id_user');
       return $this->hasMany(Proyecto::class);
    }
}
