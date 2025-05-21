<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    protected $fillable = ['post_id', 'filename'];

    public function product()
    {
        return $this->belongsTo(Post::class);
    }

    // Accesor para URL completa de la imagen
    public function getUrlAttribute()
    {
        return asset('storage/product_images/' . $this->filename);
    }
}
