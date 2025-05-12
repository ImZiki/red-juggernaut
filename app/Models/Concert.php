<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Concert extends Model
{
    protected $fillable = [
        'title',
        'date',
        'location',
        'ticket_url',
        'product_id'];

    /**
     * Relación con el modelo Producto (opcional).
     * Si tienes un modelo Product, puedes definir la relación.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
