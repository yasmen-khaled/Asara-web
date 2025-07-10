<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cottage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'cover_image',
        'images',
        'videos',
        'main_video',
        'features',
        'featured',
        'active',
        'bedrooms',
        'bathrooms',
        'max_guests',
        'location',
        'address',
        'latitude',
        'longitude',
        'rating',
        'total_reviews'
    ];

    protected $casts = [
        'images' => 'array',
        'videos' => 'array',
        'features' => 'array',
        'featured' => 'boolean',
        'active' => 'boolean',
        'price' => 'decimal:2',
        'rating' => 'decimal:2',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8'
    ];

    public function bookingRequests()
    {
        return $this->hasMany(BookingRequest::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getCoverImageUrlAttribute()
    {
        if ($this->cover_image) {
            return asset('images/' . $this->cover_image);
        }
        return asset('images/r1.jpg');
    }

    public function getImagesUrlsAttribute()
    {
        if ($this->images) {
            return array_map(function($image) {
                return asset('images/' . $image);
            }, $this->images);
        }
        return [];
    }

    public function getVideosUrlsAttribute()
    {
        if ($this->videos) {
            return array_map(function($video) {
                return asset('videos/' . $video);
            }, $this->videos);
        }
        return [];
    }

    public function getMainVideoUrlAttribute()
    {
        if ($this->main_video) {
            return asset('videos/' . $this->main_video);
        }
        return null;
    }
} 