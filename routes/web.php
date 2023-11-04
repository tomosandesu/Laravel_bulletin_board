<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;

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
//投稿一覧画面表示
Route::get('post/index', [PostController::class, 'index'])->name('post.index');
// 投稿フォーム表示
Route::get('post/create', [PostController::class, 'create'])->name('post.create');
// 投稿フォーム内容を保存
Route::post('post', [PostController::class, 'store'])->name('post.store');
//投稿詳細画面表示
Route::get('post/{post}', [PostController::class, 'show'])->name('post.show');
//編集画面表示
Route::get('post/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
//編集内容を更新
Route::patch('post/{post}', [PostController::class, 'update'])->name('post.update');
//投稿内容の削除処理
//ルーティングメソッドとしてdeleteは存在しないため、deleteととする‼️
Route::delete('post/{post}', [PostController::class, 'destroy'])->name('post.destroy');
//返信画面表示
Route::get('posts/{post}/comment', [CommentController::class, 'create'])->name('comments.create');
//返信内容の保存処理
Route::post('posts/{post}/comment', [CommentController::class, 'store'])->name('comments.store');
//返信内容の編集画面表示
Route::get('comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
//返信内容の更新処理
Route::patch('comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
//返信内容の削除処理
Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
//いいね保存処理
//いいねしたらDBにカウント追加する
Route::post('post/{post}/like', [LikeController::class, 'store'])->name('likes.store');
//いいね削除処理
Route::delete('post/{post}/like', [LikeController::class, 'destroy'])->name('likes.destroy');
require __DIR__.'/auth.php';
