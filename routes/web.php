<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\PlanedBookController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BookNotesHomeController;

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

//ログアウト
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// ホーム画面関係
//ホーム画面を表示
Route::get('/booknotes/home', [BookNotesHomeController::class, 'noteHome'])->name('note.home');

//読みたい本リストについて
//登録画面を表示
Route::get('/planedbook/create', [PlanedBookController::class, 'planedBookCreate'])->name('planedBook.create');
//登録処理を実行
Route::post('/planedbook/store', [PlanedBookController::class, 'planedBookStore'])->name('planedBook.store');
//編集画面を表示
Route::get('/planedbook/edit/{id}', [PlanedBookController::class, 'planedBookEdit'])->name('planedBook.edit');
//編集内容を更新
Route::post('/planedbook/update', [PlanedBookController::class, 'planedBookUpdate'])->name('planedBook.update');
//削除処理を実行
Route::post('/planedbook/delete/{id}', [PlanedBookController::class, 'planedBookDelete'])->name('planedBook.delete');
//検索実行
Route::get('/planedbook/search', [PlanedBookController::class, 'planedBookSearch'])->name('planedBook.search');


// Note登録関係
//note一覧画面を表示
Route::get('/note/index', [NoteController::class, 'noteIndex'])->name('note.index');

//Note登録画面を表示
Route::get('/note/create', [NoteController::class, 'noteCreate'])->name('note.create');



// 抜粋・シーン関係
//抜粋一覧画面を表示
Route::get('/sentence/index', [NoteController::class, 'sentenceIndex'])->name('sentence.index');

//タグ一覧画面を表示
Route::get('/tag/index', [NoteController::class, 'tagIndex'])->name('tag.index');



//note詳細画面を表示
Route::get('/note/detail', [NoteController::class, 'noteDetail'])->name('note.detail');