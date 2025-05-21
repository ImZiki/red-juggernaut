<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConcertRequest extends Model
{
    protected $fillable = [
        'email',
        'date',
        'location',
        'message',
        'status',
        'user_id',
        'processed_by',
        'processed_at',
    ];

    // Relaciones
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function processor()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    // Scope para filtrar por estado
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }
}

