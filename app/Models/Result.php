<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'quiz_id', 'score'];

    // A result belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A result belongs to a quiz
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
