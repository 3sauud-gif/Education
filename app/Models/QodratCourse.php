<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QodratCourse extends Model
{
    protected $fillable = [
        'title',
        'youtube_url',
        'thumbnail',
        'description',
    ];

    public function quizzes()
    {
        return $this->hasMany(QodratQuiz::class, 'course_id');
    }
}