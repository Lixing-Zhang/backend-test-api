<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Checkin extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function checkout(): BelongsTo
    {
        return $this->belongsTo(Checkout::class);
    }
}
