<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Session
 * @package App
 */
class Session extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'session_id',
        'session_info',
        'expired_at'
    ];
}
