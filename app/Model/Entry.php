<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Entry extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'doctor_id',
        'patient_id',
        'status_id',
        'time',
    ];


    public function entryDoctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    public function entryPatient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }



}