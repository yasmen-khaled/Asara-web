<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'cottage_id',
        'guest_name',
        'guest_email',
        'guest_phone',
        'check_in_date',
        'check_out_date',
        'guests',
        'price_per_night',
        'nights',
        'total_price',
        'status',
        'special_requests',
        'source', // website, phone, whatsapp, etc.
        'ip_address',
        'user_agent'
    ];

    protected $casts = [
        'check_in_date' => 'date',
        'check_out_date' => 'date',
        'price_per_night' => 'decimal:2',
        'total_price' => 'decimal:2',
        'guests' => 'integer',
        'nights' => 'integer'
    ];

    public function cottage()
    {
        return $this->belongsTo(Cottage::class);
    }

    public function getStatusBadgeAttribute()
    {
        $statuses = [
            'pending' => 'badge-warning',
            'confirmed' => 'badge-success',
            'cancelled' => 'badge-danger',
            'completed' => 'badge-info'
        ];

        return $statuses[$this->status] ?? 'badge-secondary';
    }

    public function getStatusTextAttribute()
    {
        $statuses = [
            'pending' => 'في الانتظار',
            'confirmed' => 'مؤكد',
            'cancelled' => 'ملغي',
            'completed' => 'مكتمل'
        ];

        return $statuses[$this->status] ?? $this->status;
    }
} 