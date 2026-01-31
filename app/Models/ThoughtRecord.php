<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThoughtRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'situation',
        'emotion',
        'emotion_intensity',
        'automatic_thought',
        'evidence',
        'counter_evidence',
        'adaptive_thought',
        'emotion_after',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    /**
     * このレコードはUserに属する
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}