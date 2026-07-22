<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'subcategory_id',
        'name',
        'description',
        'price',
        'image',
        'stock',
        'is_featured',
    ];

    // rs one product to one subcategory 
    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class);
    }

    // rs product to many add-ons 
    public function addOns(): BelongsToMany
    {
        return $this->belongsToMany(AddOn::class, 'product_addon', 'product_id', 'addon_id');
    }

    // rs product to many cart items
    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    //rs product to many order items
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function casts(): array{
        return['is_featured'=>'boolean'];
    }

    public function favoritedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites');
    }
}