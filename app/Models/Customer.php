<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'phone',
    ];

    public function bookingRequests()
    {
        return $this->hasMany(BookingRequest::class);
    }
}
