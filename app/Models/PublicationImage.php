<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicationImage extends Model
{
    use HasFactory;

    public function Publication()
    {
        //return $this->belongsTo(Publication::class, foreignKey: 'id', ownerKey: 'id_publication');
        return $this->hasOne(Publication::class, foreignKey: 'id_publication', localKey: 'id');
    }
    
}
