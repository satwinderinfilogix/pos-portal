<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserActivity extends Model
{
    use HasFactory;
    protected $table = 'users_activities';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
