<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnavailableSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'time',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'date',
        'time' => 'datetime:H:i',
    ];

    /**
     * Get the user that owns the unavailable schedule.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

