<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserTaxi extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'taxi_id', 'price', 'color', 'trial_color'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function original(): BelongsTo
    {
        return $this->belongsTo(Taxi::class, 'taxi_id');
    }
}
