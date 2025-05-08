<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Src\Auth\IdentityInterface;

class Doctor extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'surname',
        'name',
        'patronym',
        'birth_date',
        'user_id',
    ];

    public function doctorUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function specializations()
    {
        return $this->belongsToMany(
            Specialization::class,
            'doctor_specializations',
            'doctor_id',
            'specialization_id'
        );
    }

    public function position()
    {
        return $this->belongsToMany(
            Position::class,
            'doctor_positions',
            'doctor_id',
            'position_id'
        );
    }
}