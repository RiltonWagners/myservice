<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Business extends Model
{
    use HasFactory;

    protected static function booted()
    {
        
        static::creating(function ($business){
            $business->slug = Str::slug($business->name);
        });

        static::updating(function ($business){
            $business->slug = Str::slug($business->name);
        });
    }

    public function City()
    {
        return $this->hasOne(City::class, foreignKey: 'code', localKey: 'id_city');
    }

    public function Service()
    {
        return $this->hasOne(Service::class, foreignKey: 'id', localKey: 'id_service');
    }
    
    public function User()
    {
        return $this->hasOne(User::class, foreignKey: 'id_business', localKey: 'id');
    }
    
    public function BusinessImage()
    {
        return $this->hasMany(BusinessImage::class, foreignKey: 'id_business', localKey: 'id');
    }

    public function BusinessService()
    {
        return $this->hasMany(BusinessService::class, foreignKey: 'id_business', localKey: 'id');
    }

}
