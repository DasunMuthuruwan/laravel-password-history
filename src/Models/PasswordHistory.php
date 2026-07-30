<?php

namespace DevDasun\PasswordHistory\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class PasswordHistory extends Model
{
    public $timestamps = false;

    protected $fillable = ['password'];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function historyable(): MorphTo
    {
        return $this->morphTo();
    }
}