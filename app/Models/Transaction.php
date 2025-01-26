<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        "code",
        "user_id",
        "service_id",
        "status",
        "total_price",
        "payment_type",
        "transation_date",
        "start_time",
        "end_time",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function detail_transations()
    {
        return $this->hasMany(DetailTransaction::class);
    }
}
