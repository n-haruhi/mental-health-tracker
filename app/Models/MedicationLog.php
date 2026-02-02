<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicationLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'record_id',
        'medication_id',
        'medication_name',
        'timing',
        'taken',
    ];

    protected $casts = [
        'taken' => 'boolean',
    ];

    public function record()
    {
        return $this->belongsTo(Record::class);
    }

    public function medication()
    {
        return $this->belongsTo(Medication::class);
    }

    public function getDisplayNameAttribute()
    {
        return $this->medication?->name ?? $this->medication_name;
    }
}