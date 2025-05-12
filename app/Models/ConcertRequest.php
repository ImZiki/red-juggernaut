<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConcertRequest extends Model
{
    protected $fillable = [
        'request_name',
        'email',
        'venue',
        'date',
        'message'
    ];
}
