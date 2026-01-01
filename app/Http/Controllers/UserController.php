<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TahseeliQuiz;   
use App\Models\TahseeliCourse; 
use App\Models\QodratQuiz;
use App\Models\QodratCourse;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function courses($type)
    {
        if ($type == 'tahseeli') {
            $courses = TahseeliCourse::all();
        } else {
            $courses = QodratCourse::all();
        }

        return view('user.courses', compact('courses', 'type'));
    }

    public function show($type, $id)
    {
        if ($type == 'tahseeli') {
            $course = TahseeliCourse::with('quizzes')->findOrFail($id);
        } else {
            $course = QodratCourse::with('quizzes')->findOrFail($id);
        }

        return view('user.show', compact('course', 'type'));
    }
}
