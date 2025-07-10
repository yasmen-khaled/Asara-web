<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id', 'checkin', 'checkout', 'guests', 'notes', 'status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
