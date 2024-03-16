<?php

use App\Http\Livewire\User\UserList;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Level\LevelList;
use App\Http\Livewire\Course\CourseList;
use App\Http\Livewire\Student\StudentList;
use App\Http\Livewire\Subject\SubjectList;
use App\Http\Livewire\Teacher\TeacherList;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Livewire\Authentication\RoleList;
use App\Http\Livewire\Enrollment\EnrollmentList;
use App\Http\Livewire\Authentication\PermissionList;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('user', UserList::class);
    
    Route::get('role', RoleList::class);
    Route::get('permission', PermissionList::class);

    Route::get('teachers', TeacherList::class);
    Route::get('students', StudentList::class);

    Route::get('subjects', SubjectList::class);
    Route::get('courses', CourseList::class);
    Route::get('levels', LevelList::class);
    Route::get('enrollments', EnrollmentList::class);
});

require __DIR__.'/auth.php';
