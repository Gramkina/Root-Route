<?php

use App\Http\Controllers\AccountsController;
use App\Http\Controllers\InviteController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
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

/* Users */
Route::get('/registration/{inviteCode:code}', [UserController::class, 'registrationIndex'])->middleware('guest');
Route::post('/registration', [UserController::class, 'registration'])->name('users.registration')->middleware('guest');
Route::get('/users/add', [UserController::class, 'create'])->name('users.add');
Route::get('/users/', [UserController::class, 'index'])->middleware(['auth', 'role:admin'])->name('users.index');
Route::get('/users/page/{page?}', [UserController::class, 'index'])->where('page', '[1-9][0-9]{0,}')->middleware(['auth', 'role:admin'])->name('users.index.page');
Route::resource('users', UserController::class)->except(['index', 'create']);

/* Invites */
Route::get('/invites', [InviteController::class, 'index'])->middleware(['auth', 'role:admin'])->name('invites.index');
Route::get('/invites/page/{page?}', [InviteController::class, 'index'])->where('page', '[1-9][0-9]{0,}')->middleware(['auth', 'role:admin'])->name('invites.index.page');
Route::resource('invites', InviteController::class)->except(['index']);

/* Accounts */
Route::get('/accounts/{page?}', [AccountsController::class, 'index'])->where('page', '[1-9][0-9]{0,}')->middleware(['auth', 'role:admin'])->name('accounts.index');
Route::resource('accounts', AccountsController::class)->except(['index']);

/* Storage */
Route::middleware(['auth', 'role:user'])->group(function(){
    Route::post('/createFolder', \App\Http\Controllers\Storage\CreateFolderController::class);
    Route::get('/shared-storage', \App\Http\Controllers\Storage\IndexController::class)->name('shared_storage');
    Route::get('/personal-storage', \App\Http\Controllers\Storage\IndexController::class)->name('personal_storage');
    Route::post('/uploadFile', \App\Http\Controllers\Storage\UploadFileController::class);
    Route::get('/download-file/{file:hash_name}', \App\Http\Controllers\Storage\DownloadFileController::class)->name('download_file');
    Route::get('/edit-file/{file:hash_name}', \App\Http\Controllers\Storage\IndexEditFileController::class)->name('edit_file');
    Route::get('/file/{file:hash_name}', \App\Http\Controllers\Storage\FileIndexController::class)->name('file');
    Route::post('/addFileVersion', \App\Http\Controllers\Storage\AddFileVersionController::class);
    Route::post('/save-edit-file', \App\Http\Controllers\Storage\SaveChangeFileController::class);
    Route::get('/comments/{file:hash_name}', \App\Http\Controllers\Storage\CommentsIndexController::class)->name('comments');
    Route::post('/add-comment', \App\Http\Controllers\Storage\AddCommentController::class);
    Route::get('/tasks/my', [App\Http\Controllers\Task\TaskIndexController::class, 'indexMyTask'])->name('tasks.my');
    Route::get('/task/add', [\App\Http\Controllers\Task\TaskAddController::class, 'index'])->name('task.add');
    Route::post('/task/add', [\App\Http\Controllers\Task\TaskAddController::class, 'addTask']);
    Route::get('/tasks/to-me', [App\Http\Controllers\Task\TaskIndexController::class, 'indexToMeTask'])->name('tasks.tome');
    Route::get('/task/{task}', App\Http\Controllers\Task\TaskController::class)->name('task.task');
});


Route::name('auth.')->group(function(){
    Route::post('/loginUser', [LoginController::class, 'login'])->name('login');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');
});



Route::view('/', 'login')->name('login')->middleware('guest');
Route::view('/home', 'home')->name('home')->middleware('auth');


Route::get('/setLanguage', [\App\Http\Controllers\LanguageController::class, 'setLanguage']);
