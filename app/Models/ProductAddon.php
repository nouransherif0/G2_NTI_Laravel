<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductAddon extends Model
{
    use HasFactory;

    protected $table = 'product_addon';

    protected $fillable = [
        'product_id',
        'addon_id',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function addOn(): BelongsTo
    {
        return $this->belongsTo(AddOn::class, 'addon_id');
    }
}