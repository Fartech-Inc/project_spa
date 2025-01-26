<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'service_category_id',
        'name',
        'price',
        'description'
    ];

    public function service_category()
    {
        return $this->belongsTo(ServiceCategory::class);
    }

    public function service_galleries()
    {
        return $this->hasMany(ServiceGallery::class);
    }

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }
}
