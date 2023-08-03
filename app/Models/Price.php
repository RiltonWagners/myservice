<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    public function Plan()
    {
        return $this->hasOne(Plan::class, foreignKey: 'id', localKey: 'id_plan');
    }


}
