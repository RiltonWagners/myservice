<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Publication extends Model
{
    use HasFactory;

    public function city()
    {
        return $this->hasOne(City::class, foreignKey: 'code', localKey: 'id_city');
    }

    public function service()
    {
        return $this->hasOne(Service::class, foreignKey: 'id', localKey: 'id_service');
    }
    
    public function PublicationImage()
    {
        return $this->hasMany(PublicationImage::class, foreignKey: 'id_publication', localKey: 'id');
    }

    protected static function booted()
    {
        static::creating(function ($publication){
            $publication->slug = Str::slug($publication->title);
        });

        static::updating(function ($publication){
            $publication->slug = Str::slug($publication->title);
        });

    }

}
