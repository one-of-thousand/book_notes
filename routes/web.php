<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\PlanedBookController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BookNotesHomeController;
use App\Http\Controllers\SentenceController;
use App\Http\Controllers\TagController;

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
    return redirect(route('note.index'));
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
//Note登録処理を実行
Route::post('/note/store', [NoteController::class, 'noteStore'])->name('note.store');
//note詳細画面を表示
Route::get('/note/detail/{id}', [NoteController::class, 'noteDetail'])->name('note.detail');
//小ジャンルを表示
Route::post('/note/genre', [NoteController::class, 'noteSmallGenreSelect'])->name('note.genreSelect');
//note編集画面を表示
Route::get('/note/edit/{id}', [NoteController::class, 'noteEdit'])->name('note.edit');
//Note更新処理を実行
Route::post('/note/update', [NoteController::class, 'noteUpdate'])->name('note.update');
//Noteを削除
Route::post('/note/delete/{id}', [NoteController::class, 'noteDelete'])->name('note.delete');
//Note検索を実行
Route::get('/note/search', [NoteController::class, 'noteSearch'])->name('note.search');


// 抜粋・シーン関係
//抜粋一覧画面を表示
Route::get('/sentence/index', [SentenceController::class, 'sentenceIndex'])->name('sentence.index');
//抜粋詳細画面を表示
Route::get('/sentence/detail/{id}', [SentenceController::class, 'sentenceDetail'])->name('sentence.detail');
//抜粋変更内容を更新
Route::post('/sentence/update', [SentenceController::class, 'sentenceUpdate'])->name('sentence.update');
//抜粋詳細画面を表示
Route::get('/sentence/edit/{id}', [SentenceController::class, 'sentenceEdit'])->name('sentence.edit');
//抜粋を削除
Route::post('/sentence/delete/{id}', [SentenceController::class, 'sentenceDelete'])->name('sentence.delete');


//タグ関係
//タグ一覧画面を表示
Route::get('/tag/index', [TagController::class, 'tagIndex'])->name('tag.index');
