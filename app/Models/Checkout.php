<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Checkout extends Model
{
    use HasFactory;

    const TYPE_LOAN = 'loan';
    const TYPE_TEST_DRIVE = 'test drive';

    protected $guarded = [];

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function checkin(): HasOne
    {
        return $this->hasOne(Checkin::class);
    }
}
