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
        "total_paid",
        "payment_type",
        "transaction_date",
        "start_time",
        "end_time",
        "token",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function detail_transactions()
    {
        return $this->hasMany(DetailTransaction::class);
    }
}
