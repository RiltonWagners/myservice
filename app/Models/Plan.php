<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
/*
    public function Price()
    {
        return $this->hasMany(Price::class, foreignKey: 'id', localKey: 'id_plan');
    }
*/
    public function Price()
    {
        return $this->hasMany(Price::class, foreignKey: 'id_plan', localKey: 'id')->where('active', 'true');
    }


}
