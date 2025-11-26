<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
//タスク管理用
use App\Http\Controllers\TaskController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
//dashboardにタスクを表示用ルート
Route::get('/dashboard', [TaskController::class, 'dashboard'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {

    //記事一覧＆詳細画面
    Route::get('/admin/posts', [PostController::class, 'index'])->name('admin.posts.index');//一覧へ
    Route::get('/admin/posts/{id}/detail', [PostController::class, 'show'])->name('admin.posts.show');//詳細へ

    Route::get('/admin/posts/create', [PostController::class, 'create'])->name('admin.posts.create');//入力へ
    Route::post('/admin/posts/store', [PostController::class, 'store'])->name('admin.posts.store');//保存処理

    // 編集フォームの表示
    Route::get('/admin/posts/{id}/edit', [PostController::class, 'edit'])->name('admin.posts.edit');//編集へ
        // 更新処理の実行
    Route::put('/admin/posts/{id}/update', [PostController::class, 'update'])->name('admin.posts.update');//更新処理

    Route::delete('/admin/posts/{id}/destroy', [PostController::class, 'destroy'])->name('admin.posts.destroy');//削除処理

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //以下タスク管理用
    Route::get('/admin/tasks', [TaskController::class, 'index'])->name('admin.tasks.index');//一覧へ
    Route::get('/admin/tasks/{id}/detail', [TaskController::class, 'show'])->name('admin.tasks.show');//詳細へ

    Route::get('/admin/tasks/create', [TaskController::class, 'create'])->name('admin.tasks.create');//入力へ
    Route::post('/admin/tasks/store', [TaskController::class, 'store'])->name('admin.tasks.store');//保存処理

    Route::get('/admin/tasks/{id}/edit', [TaskController::class, 'edit'])->name('admin.tasks.edit');//編集へ
        // 更新処理の実行
    Route::put('/admin/tasks/{id}/update', [TaskController::class, 'update'])->name('admin.tasks.update');//更新処理
    Route::delete('/admin/tasks/{id}/destroy', [TaskController::class, 'destroy'])->name('admin.tasks.destroy');//削除処理

    //以下追加仕様
    

});

require __DIR__.'/auth.php';
