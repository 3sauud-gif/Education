<?php

use Illuminate\Support\Facades\Route;
use App\Models\TahseeliCourse;
use App\Models\QodratCourse;
use App\Http\Controllers\TahseeliCourseController;
use App\Http\Controllers\TahseeliQuizController;
use App\Http\Controllers\QodratCourseController;
use App\Http\Controllers\QodratQuizController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Tahseeli Courses
Route::prefix('admin/tahseeli')->group(function () {

    Route::get('/courses', [TahseeliCourseController::class, 'index'])->name('tahseeli.courses.index');
    Route::get('/courses/create', [TahseeliCourseController::class, 'create'])->name('tahseeli.courses.create');
    Route::post('/courses/store', [TahseeliCourseController::class, 'store'])->name('tahseeli.courses.store');
    Route::get('/courses/{id}', [TahseeliCourseController::class, 'show'])->name('tahseeli.courses.show');
    Route::get('/courses/{id}/edit', [TahseeliCourseController::class, 'edit'])->name('tahseeli.courses.edit');
    Route::put('/courses/{id}/update', [TahseeliCourseController::class, 'update'])->name('tahseeli.courses.update');
    Route::delete('/courses/{id}/delete', [TahseeliCourseController::class, 'destroy'])->name('tahseeli.courses.delete');

});

// Tahseeli Quizzes
Route::prefix('admin/tahseeli/quizzes')->group(function () {

    Route::get('/{course_id}', [TahseeliQuizController::class, 'index'])->name('tahseeli.quizzes.index');
    Route::post('/{course_id}/store', [TahseeliQuizController::class, 'store'])->name('tahseeli.quizzes.store');
    Route::delete('/delete/{id}', [TahseeliQuizController::class, 'destroy'])->name('tahseeli.quizzes.delete');

});

// Qodrat Courses
Route::prefix('admin/qodrat')->group(function () {

    Route::get('/courses', [QodratCourseController::class, 'index'])->name('qodrat.courses.index');
    Route::get('/courses/create', [QodratCourseController::class, 'create'])->name('qodrat.courses.create');
    Route::post('/courses/store', [QodratCourseController::class, 'store'])->name('qodrat.courses.store');
    Route::get('/courses/{id}', [QodratCourseController::class, 'show'])->name('qodrat.courses.show');
    Route::get('/courses/{id}/edit', [QodratCourseController::class, 'edit'])->name('qodrat.courses.edit');
    Route::put('/courses/{id}/update', [QodratCourseController::class, 'update'])->name('qodrat.courses.update');
    Route::delete('/courses/{id}/delete', [QodratCourseController::class, 'destroy'])->name('qodrat.courses.delete');

});

// Qodrat Quizzes
Route::prefix('admin/qodrat/quizzes')->group(function () {

    Route::get('/{course_id}', [QodratQuizController::class, 'index'])->name('qodrat.quizzes.index');
    Route::post('/{course_id}/store', [QodratQuizController::class, 'store'])->name('qodrat.quizzes.store');
    Route::delete('/delete/{id}', [QodratQuizController::class, 'destroy'])->name('qodrat.quizzes.delete');

});

Route::get('/learn', [UserController::class, 'index'])->name('user.index');
Route::get('/learn/{type}', [UserController::class, 'courses'])->name('user.courses');
Route::get('/learn/{type}/{course}', [UserController::class, 'show'])->name('user.show');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard', [
        'tahseeliCourses' => TahseeliCourse::all(),
        'qodratCourses' => QodratCourse::all(),
    ]);
})->name('admin.dashboard');

Route::fallback(function () {
    // لو الصفحة تبدأ بـ admin → لا ترجع المستخدم
    if (request()->is('admin/*')) {
        abort(404);
    }

    // غير كذا → رجّعه لصفحة المستخدم
    return redirect()->route('user.index');
});