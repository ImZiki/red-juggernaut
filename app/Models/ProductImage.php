<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = ['product_id', 'filename'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Accesor para URL completa de la imagen
    public function getUrlAttribute()
    {
        return asset('storage/product_images/' . $this->filename);
    }
}

