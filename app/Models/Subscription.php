<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
