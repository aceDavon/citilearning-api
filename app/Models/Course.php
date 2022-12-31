<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    public function subscriptions()
    {
        return $this->belongsToMany(Subscription::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
