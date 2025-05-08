<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorPosition extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'doctor_id',
        'position_id',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
}