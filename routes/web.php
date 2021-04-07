<?php

use App\Http\Controllers\AccountsController;
use App\Http\Controllers\InviteController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserControllerOld;

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
    Route::post('/createFolder', [StorageController::class, 'createFolder']);
    Route::get('/files', [StorageController::class, 'index'])->name('files');
    Route::post('/uploadFile', [StorageController::class, 'uploadFile']);
});


Route::name('auth.')->group(function(){
    Route::post('/loginUser', [LoginController::class, 'login'])->name('login');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');
});


Route::name('navigation.')->group(function(){
    Route::view('/', 'login')->name('login')->middleware('guest');
    Route::view('/home', 'home')->name('home')->middleware('auth');
});

Route::get('/setLanguage', [\App\Http\Controllers\LanguageController::class, 'setLanguage']);
