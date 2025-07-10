<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'cottage_id',
        'guest_name',
        'guest_email',
        'rating',
        'review_text',
        'photos',
        'stay_date',
        'is_verified',
        'is_approved',
        'ip_address'
    ];

    protected $casts = [
        'rating' => 'integer',
        'stay_date' => 'date',
        'photos' => 'array',
        'is_verified' => 'boolean',
        'is_approved' => 'boolean'
    ];

    public function cottage()
    {
        return $this->belongsTo(Cottage::class);
    }

    public function getRatingStarsAttribute()
    {
        $stars = '';
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $this->rating) {
                $stars .= '<i class="fas fa-star"></i>';
            } elseif ($i - 0.5 <= $this->rating) {
                $stars .= '<i class="fas fa-star-half-alt"></i>';
            } else {
                $stars .= '<i class="far fa-star"></i>';
            }
        }
        return $stars;
    }
} 