<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image',
        'category',
        'category_id',
        'is_featured',
        'is_active',
    ];

    /**
     * Get the order items for the product.
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get all of the orders that contain this product.
     */
    public function orders()
    {
        return $this->hasManyThrough(
            Order::class,
            OrderItem::class,
            'product_id', // Foreign key on order_items table
            'id', // Foreign key on orders table
            'id', // Local key on products table
            'order_id' // Local key on order_items table
        );
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

}
