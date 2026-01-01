<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TahseeliCourse;
use App\Models\TahseeliQuiz;

class TahseeliCourseController extends Controller
{
    public function store(Request $request)
{
    
    $request->validate([
        'title' => 'required',
        'youtube_url' => 'required',
        'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png',
        'description' => 'nullable',
    ]);

    // رفع الصورة
    $thumbnailPath = null;
    if ($request->hasFile('thumbnail')) {
        $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
    }

    TahseeliCourse::create([
        'title' => $request->title,
        'youtube_url' => $request->youtube_url,
        'thumbnail' => $thumbnailPath,
        'description' => $request->description,
    ]);

    return redirect()->back()->with('success', 'تم إضافة الكورس بنجاح');
}
public function index()
{
    $courses = TahseeliCourse::latest()->get();
    return view('admin.tahseeli.index', compact('courses'));
}
public function show($id)
{
    $course = TahseeliCourse::with('quizzes')->findOrFail($id);
    return view('admin.tahseeli.show', compact('course'));
}
public function edit($id)
{
    $course = TahseeliCourse::findOrFail($id);
    return view('admin.tahseeli.edit', compact('course'));
}

public function update(Request $request, $id)
{
    $course = TahseeliCourse::findOrFail($id);

    $request->validate([
        'title' => 'required',
        'youtube_url' => 'required',
        'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png',
        'description' => 'nullable',
    ]);

    // لو رفع صورة جديدة
    if ($request->hasFile('thumbnail')) {
        $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        $course->thumbnail = $thumbnailPath;
    }

    $course->title = $request->title;
    $course->youtube_url = $request->youtube_url;
    $course->description = $request->description;
    $course->save();

    return redirect()->back()->with('success', 'تم تعديل الكورس');
}
public function destroy($id)
{
    $course = TahseeliCourse::findOrFail($id);
    $course->delete();

    return redirect()->back()->with('success', 'تم حذف الكورس');
}
public function create()
{
    return view('admin.tahseeli.create');
}
}