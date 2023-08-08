<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



//ホーム画面を表示
Route::get('/note/home', [NoteController::class, 'noteHome'])->name('note.home');

//読みたい本リストの登録画面を表示
Route::get('/planedbook/create', [NoteController::class, 'planedBookCreate'])->name('planedBook.create');


//Note登録画面を表示
Route::get('/note/create', [NoteController::class, 'noteCreate'])->name('note.create');

//note一覧画面を表示
Route::get('/note/index', [NoteController::class, 'noteIndex'])->name('note.index');


//抜粋一覧画面を表示
Route::get('/sentence/index', [NoteController::class, 'sentenceIndex'])->name('sentence.index');

//タグ一覧画面を表示
Route::get('/tag/index', [NoteController::class, 'tagIndex'])->name('tag.index');

//note詳細画面を表示
Route::get('/note/detail', [NoteController::class, 'noteDetail'])->name('note.detail');