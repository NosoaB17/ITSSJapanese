<?php
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommentCourseController;
use App\Http\Controllers\CourseAndStudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\RegisterCourseController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [CourseController::class,'index'])->middleware(['auth', 'verified'])->name('index');
Route::get('/listings/{listing}', [CourseController::class,'show'])->name('course.show');
Route::get('/createComment',[CommentController::class,'create'])->middleware(['auth', 'verified'])->name('comment.create');
Route::post('/createComment',[CommentController::class,'store'])->middleware(['auth', 'verified'])->name('comment.store');
Route::get('listings/teacher/{id}',[TeacherController::class,'show'])->name('teacher.contact');
Route::controller(CourseController::class)->group(function () {
    Route::get('/course', 'myCourse')->middleware(['auth', 'verified'])->name('myCourse');
    Route::get('/course/create', 'create')->name('course.create');
    Route::post('/course/store','store')->name('course.store');
    Route::patch('/course/{id}','update');
    Route::delete('/course/{id}','destroy');
});

Route::controller(TeacherController::class)->group(function () {
    Route::get('/teacher/{id}', 'show');
    Route::get('/teacher', 'list');
    Route::post('/teacher','create');
    Route::patch('/teacher/{id}','update');
    Route::delete('/teacher/{id}','destroy');
});

Route::controller(CourseAndStudentController::class)->group(function () {
    Route::post('/addStudentToCourse','addStudentToCourse')->name('student.join');
})->middleware(['auth', 'verified'])->name('joinCourse');

Route::controller(RegisterCourseController::class)->group(function () {
    Route::get('/requests','index')->name('request.index');
    Route::post('/createRequest','createRequest')->middleware(['auth', 'verified'])->name('request.create');
    Route::post('/requestToCourse','requestToCourse');
    Route::post('/listRequest','listRequest');
});

Route::controller(CommentCourseController::class)->group(function () {
    Route::get('/getComment','list');
});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile', [ProfileController::class, 'edit2'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';