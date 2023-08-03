<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessService extends Model
{
    use HasFactory;
    protected $fillable = ['id_business', 'id_service'];

    public function Business()
    {
        return $this->hasOne(Business::class, foreignKey: 'id', localKey: 'id_business');
    }

    public function Service()
    {
        return $this->hasMany(Service::class, foreignKey: 'id', localKey: 'id_service');
    }

}
