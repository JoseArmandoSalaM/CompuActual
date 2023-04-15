<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostico extends Model
{
    use HasFactory;

    public function hallazgo()
    {
       // return $this->hasMany(User::class,'id');
        return $this->belongsTo(Hallazgo::class);
    }

    public function proyectos()
    {
        return $this->belongsToMany(Proyecto::class, 'diagnostico_proyecto');
    }
    
}
