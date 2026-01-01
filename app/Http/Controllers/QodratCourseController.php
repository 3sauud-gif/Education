<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QodratCourse;

class QodratCourseController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'youtube_url' => 'required',
        'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png',
        'description' => 'nullable',
    ]);

    $thumbnailPath = null;
    if ($request->hasFile('thumbnail')) {
        $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
    }

    QodratCourse::create([
        'title' => $request->title,
        'youtube_url' => $request->youtube_url,
        'thumbnail' => $thumbnailPath,
        'description' => $request->description,
    ]);

    return redirect()->back()->with('success', 'تم إضافة كورس القدرات بنجاح');
}
public function index()
{
    $courses = QodratCourse::latest()->get();
    return view('admin.qodrat.index', compact('courses'));
}
public function show($id)
{
    $course = QodratCourse::with('quizzes')->findOrFail($id);
    return view('admin.qodrat.show', compact('course'));
}
public function edit($id)
{
    $course = QodratCourse::findOrFail($id);
    return view('admin.qodrat.edit', compact('course'));
}

public function update(Request $request, $id)
{
    $course = QodratCourse::findOrFail($id);

    $request->validate([
        'title' => 'required',
        'youtube_url' => 'required',
        'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png',
        'description' => 'nullable',
    ]);

    if ($request->hasFile('thumbnail')) {
        $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        $course->thumbnail = $thumbnailPath;
    }

    $course->title = $request->title;
    $course->youtube_url = $request->youtube_url;
    $course->description = $request->description;
    $course->save();

    return redirect()->back()->with('success', 'تم تعديل كورس القدرات');
}
public function destroy($id)
{
    $course = QodratCourse::findOrFail($id);
    $course->delete();

    return redirect()->back()->with('success', 'تم حذف الكورس');
}
public function create()
{
    return view('admin.qodrat.create');
}
}
