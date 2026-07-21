<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AddOn extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price_adjustment',
    ];

    //rs add-on to many products 
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_addon', 'addon_id', 'product_id');
    }
}