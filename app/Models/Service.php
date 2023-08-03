<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->hasOne(Category::class, foreignKey: 'id', localKey: 'id_category');
    }

    public function BusinessService()
    {
        return $this->hasOne(BusinessService::class, foreignKey: 'id_service', localKey: 'id');
    }

    protected static function booted()
    {
        static::creating(function ($service){
            $service->slug = Str::slug($service->name);
        });

        static::updating(function ($service){
            $service->slug = Str::slug($service->name);
        });

    }
}
