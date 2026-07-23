<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'full_name',
        'phone_number',
        'email_address',
        'guests',
        'reservation_date',
        'reservation_time',
        'special_requests',
    ];
}
