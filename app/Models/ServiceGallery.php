<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceGallery extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'service_id',
        'image',
        'is_thumbnail'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
