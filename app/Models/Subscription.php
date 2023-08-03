<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_customer',
        'status',
        'id_price',
        'id_product'
    ];

    public function User()
    {
        return $this->hasOne(User::class, foreignKey: 'id', localKey: 'id_user');
    }
}