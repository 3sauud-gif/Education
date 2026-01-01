<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QodratQuiz;
use App\Models\QodratCourse;

class QodratQuizController extends Controller
{
    public function store(Request $request, $course_id)
{
    $request->validate([
        'question' => 'required',
        'option_a' => 'required',
        'option_b' => 'required',
        'option_c' => 'required',
        'option_d' => 'required',
        'correct_answer' => 'required',
    ]);

    QodratQuiz::create([
        'course_id' => $course_id,
        'question' => $request->question,
        'option_a' => $request->option_a,
        'option_b' => $request->option_b,
        'option_c' => $request->option_c,
        'option_d' => $request->option_d,
        'correct_answer' => $request->correct_answer,
    ]);

    return redirect()->back()->with('success', 'تم إضافة السؤال بنجاح');
}
public function index($course_id)
{
    $course = QodratCourse::with('quizzes')->findOrFail($course_id);
    return view('admin.qodrat.show', compact('course'));
}
public function edit($id)
{
    $quiz = QodratQuiz::findOrFail($id);
    return view('admin.qodrat.quizzes.edit', compact('quiz'));
}

public function update(Request $request, $id)
{
    $quiz = QodratQuiz::findOrFail($id);

    $request->validate([
        'question' => 'required',
        'option_a' => 'required',
        'option_b' => 'required',
        'option_c' => 'required',
        'option_d' => 'required',
        'correct_answer' => 'required',
    ]);

    $quiz->update([
        'question' => $request->question,
        'option_a' => $request->option_a,
        'option_b' => $request->option_b,
        'option_c' => $request->option_c,
        'option_d' => $request->option_d,
        'correct_answer' => $request->correct_answer,
    ]);

    return redirect()->back()->with('success', 'تم تعديل السؤال');
}
public function destroy($id)
{
    $quiz = QodratQuiz::findOrFail($id);
    $quiz->delete();

    return redirect()->back()->with('success', 'تم حذف السؤال');
}
public function show($id)
{
    $course = QodratCourse::findOrFail($id);
    return view('admin.qodrat.courses.show', compact('course'));
}
}
