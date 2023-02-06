<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StudentClassController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\CounselingController;
use App\Http\Controllers\Admin\ProblemController;
use App\Http\Controllers\Admin\SolutionController;
use App\Http\Controllers\CounselingTeacher;
use App\Http\Controllers\Counselor\DashboardController as CounselorDashboardController;
use App\Http\Controllers\Counselor\PostController as CounselorPostController;
use App\Http\Controllers\Counselor\CommentController as CounselorCommentController;
use App\Http\Controllers\Counselor\StudentController as CounselorStudentController;
use App\Http\Controllers\Counselor\StudentClassController as CounselorStudentClassController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return redirect('/login');
});

Auth::routes([
	'register' => false
]);

Route::group(['middleware' => 'admin'], function () {
	Route::get('/admin', [DashboardController::class, 'index'])->name('admin');
	/** Student Class */
	Route::get('/admin/student-class', [StudentClassController::class, 'index']);
	Route::get('/admin/student-class/create', [StudentClassController::class, 'create']);
	Route::post('/admin/student-class/store', [StudentClassController::class, 'store']);
	Route::get('/admin/student-class/edit/{studentClass}', [StudentClassController::class, 'edit']);
	Route::put('/admin/student-class/update/{studentClass}', [StudentClassController::class, 'update']);
	Route::delete('/admin/student-class/destroy/{studentClass}', [StudentClassController::class, 'destroy']);
	/** Student */
	Route::get('/admin/student', [StudentController::class, 'index']);
	Route::get('/admin/student/create', [StudentController::class, 'create']);
	Route::post('/admin/student/store', [StudentController::class, 'store']);
	Route::get('/admin/student/edit/{student}', [StudentController::class, 'edit']);
	Route::put('/admin/student/update/{student}', [StudentController::class, 'update']);
	Route::delete('/admin/student/destroy/{student}', [StudentController::class, 'destroy']);
	/** Forum Discussion */
	Route::get('/admin/forum', [PostController::class, 'index']);
	Route::get('/admin/forum/create', [PostController::class, 'create']);
	Route::post('/admin/forum/store', [PostController::class, 'store']);
	Route::get('/admin/forum/show/{post}', [PostController::class, 'show'])->name('admin.post.show');
	Route::get('/admin/forum/edit/{post}', [PostController::class, 'edit']);
	Route::put('/admin/forum/update/{post}', [PostController::class, 'update']);
	Route::delete('/admin/forum/destroy/{post}', [PostController::class, 'destroy']);
	/** Comments */
	Route::post('/admin/forum/comment/store/{post}', [CommentController::class, 'store']);
	Route::get('/admin/forum/comment/edit/{comment}', [CommentController::class, 'edit']);
	Route::put('/admin/forum/comment/update/{comment}', [CommentController::class, 'update']);
	Route::delete('/admin/forum/destroy/comment/{comment}', [CommentController::class, 'destroy']);
	/** Problem */
	Route::get('/admin/problem', [ProblemController::class, 'index']);
	Route::get('/admin/problem/create', [ProblemController::class, 'create']);
	Route::post('/admin/problem/store', [ProblemController::class, 'store']);
	Route::get('/admin/problem/edit/{problem}', [ProblemController::class, 'edit']);
	Route::put('/admin/problem/update/{problem}', [ProblemController::class, 'update']);
	Route::delete('/admin/problem/destroy/{problem}', [ProblemController::class, 'destroy']);
	/** Counseling */
	Route::get('/admin/counseling', [CounselingController::class, 'index']);
	Route::get('/admin/counseling/create', [CounselingController::class, 'create']);
	Route::post('/admin/counseling/store', [CounselingController::class, 'store']);
	Route::get('/admin/counseling/find_student', [CounselingController::class, 'find_nis'])->name('find_student');
	Route::get('/admin/counseling/show/{counseling}', [CounselingController::class, 'show'])->name('admin.counseling.show');
	Route::get('/admin/counseling/edit/{counseling}', [CounselingController::class, 'edit']);
	Route::put('/admin/counseling/update/{counseling}', [CounselingController::class, 'update']);
	Route::delete('/admin/counseling/destroy/{counseling}', [CounselingController::class, 'destroy']);
	/** Find the Problem Solution with CBR Method */
	Route::get('/admin/solution', [SolutionController::class, 'index']);
	Route::post('/admin/solution/show', [SolutionController::class, 'show_solution']);
});

/** Counseling Teacher */
Route::group(['middleware' => 'counselor'], function () {
	Route::get('/counselor', [CounselorDashboardController::class, 'index']);
	/** Student Class */
	Route::get('/counselor/student-class', [CounselorStudentClassController::class, 'index']);
	Route::get('/counselor/student-class/create', [CounselorStudentClassController::class, 'create']);
	Route::post('/counselor/student-class/store', [CounselorStudentClassController::class, 'store']);
	Route::get('/counselor/student-class/edit/{studentClass}', [CounselorStudentClassController::class, 'edit']);
	Route::put('/counselor/student-class/update/{studentClass}', [CounselorStudentClassController::class, 'update']);
	Route::delete('/counselor/student-class/destroy/{studentClass}', [CounselorStudentClassController::class, 'destroy']);
	/** Student */
	Route::get('/counselor/student', [CounselorStudentController::class, 'index']);
	Route::get('/counselor/student/create', [CounselorStudentController::class, 'create']);
	Route::post('/counselor/student/store', [CounselorStudentController::class, 'store']);
	Route::get('/counselor/student/edit/{student}', [CounselorStudentController::class, 'edit']);
	Route::put('/counselor/student/update/{student}', [CounselorStudentController::class, 'update']);
	Route::delete('/counselor/student/destroy/{student}', [CounselorStudentController::class, 'destroy']);
	/** Forum Discussion */
	Route::get('/counselor/forum', [CounselorPostController::class, 'index']);
	Route::get('/counselor/forum/create', [CounselorPostController::class, 'create']);
	Route::post('/counselor/forum/store', [CounselorPostController::class, 'store']);
	Route::get('/counselor/forum/show/{post}', [CounselorPostController::class, 'show'])->name('counselor.post.show');
	Route::get('/counselor/forum/edit/{post}', [CounselorPostController::class, 'edit']);
	Route::put('/counselor/forum/update/{post}', [CounselorPostController::class, 'update']);
	Route::delete('/counselor/forum/destroy/{post}', [CounselorPostController::class, 'destroy']);
	/** Comments */
	Route::post('/counselor/forum/comment/store/{post}', [CounselorCommentController::class, 'store']);
	Route::get('/counselor/forum/comment/edit/{comment}', [CounselorCommentController::class, 'edit']);
	Route::put('/counselor/forum/comment/update/{comment}', [CounselorCommentController::class, 'update']);
	Route::delete('/counselor/forum/destroy/comment/{comment}', [CounselorCommentController::class, 'destroy']);
});


Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade'); 
	 Route::get('map', function () {return view('pages.maps');})->name('map');
	 Route::get('icons', function () {return view('pages.icons');})->name('icons'); 
	 Route::get('table-list', function () {return view('pages.tables');})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

Route::get('/students', [StudentController::class, 'index']);
