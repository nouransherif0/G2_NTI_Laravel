<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\hasmany;


class AddOn extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price_adjustment',
    ];

    //rs add-on to many products 
    public function products_item_addon(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_addon');
    }

    public function orderItemAddons(): HasMany
    {
        return $this->hasMany(OrderItemAddon::class);
    }
}