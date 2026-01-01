<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TahseeliCourse extends Model
{
    protected $fillable = [
        'title',
        'youtube_url',
        'thumbnail',
        'description',
    ];

    public function quizzes()
    {
        return $this->hasMany(TahseeliQuiz::class, 'course_id');
    }
}