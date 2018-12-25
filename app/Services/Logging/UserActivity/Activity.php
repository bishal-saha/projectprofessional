<?php

namespace App\Services\Logging\UserActivity;


use App\User;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    const UPDATED_AT = null;

    protected $table = 'user_activities';

    protected $fillable = ['description', 'user_id', 'ip_address', 'user_agent'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}