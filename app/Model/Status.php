<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    public function entryStatus()
    {
        return $this->belongsTo(Entry::class, 'status_id');
    }
}