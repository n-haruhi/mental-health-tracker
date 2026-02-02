<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'mood_score',
        'sleep_hours',
        'note',
        'took_medication',
    ];

    protected $casts = [
        'date' => 'date',
        'took_medication' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function medicationLogs()
    {
        return $this->hasMany(MedicationLog::class);
    }
}