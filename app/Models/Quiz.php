<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    
    protected $fillable = ['user_id', 'title'];

    // A quiz belongs to a user (creator)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A quiz has many questions
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    // A quiz has many results
    public function results()
    {
        return $this->hasMany(Result::class);
    }

}
