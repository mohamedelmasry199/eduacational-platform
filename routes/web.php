<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/home', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/home', [UserController::class, 'index'])->name('home');
Route::get('/subjects/{year}', [SubjectController::class, 'getSubjectsByYear'])->name('subjects.by.year');

Route::get('/chapters/{subject}', [SubjectController::class, 'getChaptersBySubject'])->name('chapters.by.subject');
Route::post('/get-suitable-quiz', [QuizController::class, 'getSuitableQuiz'])->name('suitable.quiz');
Route::post('/get-suitable-quiz1', [QuizController::class, 'getSuitableQuiz1'])->name('suitable.quiz1');

Route::get('/generate-code', [UserController::class, 'showGenerateCodeForm'])->name('generate_code_form');
Route::post('/generate-code', [UserController::class, 'generateCode'])->name('generate_code');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

Route::get('/dashboard/year', [DashboardController::class, 'addYear'])->name('addYear');
Route::post('/dashboard/year', [DashboardController::class, 'storeYear'])->name('storeYear');
Route::put('dashboard/updateYear/{id}',[DashboardController::class, 'updateYear'])->name('updateYear');
Route::delete('dashboard/deleteYear/{id}',[DashboardController::class, 'deleteYear'])->name('deleteYear');

Route::get('/dashboard/subject', [DashboardController::class, 'addSubject'])->name('addSubject');
Route::post('/dashboard/subject', [DashboardController::class, 'storeSubject'])->name('storeSubject');
Route::put('dashboard/updateSubject/{id}',[DashboardController::class, 'updateSubject'])->name('updateSubject');
Route::delete('dashboard/deleteSubject/{id}',[DashboardController::class, 'deleteSubject'])->name('deleteSubject');

Route::get('/dashboard/chapter', [DashboardController::class, 'addChapter'])->name('addChapter');
Route::post('/dashboard/chapter', [DashboardController::class, 'storeChapter'])->name('storeChapter');
Route::put('dashboard/updateChapter/{id}',[DashboardController::class, 'updateChapter'])->name('updateChapter');
Route::delete('dashboard/deleteChapter/{id}',[DashboardController::class, 'deleteChapter'])->name('deleteChapter');

Route::get('/dashboard/user', [DashboardController::class, 'addUser'])->name('addUser');
Route::post('/dashboard/user', [DashboardController::class, 'storeUser'])->name('storeUser');
Route::put('dashboard/updateUser/{id}',[DashboardController::class, 'updateUser'])->name('updateUser');
Route::delete('dashboard/deleteUser/{id}',[DashboardController::class, 'deleteUser'])->name('deleteUser');



Route::get('/dashboard/filters', [DashboardController::class, 'filteration'])->name('filteration');
Route::match(['get', 'post'],'dashboard/get-questions', [DashboardController::class, 'questions'])->name('editQuestions');
Route::put('/questions/{questionId}', [DashboardController::class, 'updateQuestion'])->name('update.question');
Route::get('/dashboard/create-question', [DashboardController::class, 'createQuestion'])->name('createQuestion');
Route::post('/questions/store', [DashboardController::class, 'storeQuestion'])->name('store_question');
Route::post('/update/answer/{answerId}', [DashboardController::class, 'updateAnswer'])->name('update.answer');
Route::delete('/delete/question/{questionId}', [DashboardController::class, 'deleteQuestion'])->name('delete.question');
Route::delete('/delete/answer/{answerId}', [DashboardController::class, 'deleteAnswer'])->name('delete.answer');

Route::post('/delete-all-years', [DashboardController::class ,'yearsDeleteAll'])->name('delete.all.years');
Route::post('/delete-all-subjects', [DashboardController::class ,'subjectsDeleteAll'])->name('delete.all.subjects');
Route::post('/delete-all-chapters', [DashboardController::class ,'chaptersDeleteAll'])->name('chapters.delete.all');


});
Route::get('/link', [UserController::class, 'link'])->name('link');

// Route::delete('/questions/delete/{id}', [DashboardController::class, 'deleteAnswer'])->name('delete.answer');

// Route::post('dashboard/questions/create', [DashboardController::class, 'createQuestions'])->name('store_question');

// Route::put('/questions/{id}/update', [DashboardController::class, 'updateQuestion'])->name('update_question');

// Route::delete('/questions/{id}/delete', [DashboardController::class, 'deleteQuestion'])->name('delete_question');
// Route::get('/questions/create', [DashboardController::class, 'createForm'])->name('create_question_form');

// Route for handling the creation of a new question




// Route::get('/questions/{id}/edit', [DashboardController::class, 'edit'])->name('edit_question');

// Route to update a question


require __DIR__.'/auth.php';
