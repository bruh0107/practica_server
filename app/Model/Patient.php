<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Patient extends Model
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

    public function patientUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}