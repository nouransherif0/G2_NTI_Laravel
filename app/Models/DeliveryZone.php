<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DeliveryZone extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'delivery_fee',
        'minimum_order_value',
        'estimated_time',
    ];

    //rs delivery to many saved addresses
    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }
}

