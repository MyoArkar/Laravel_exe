<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

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
Route::get('/dashboard', function(){
    return view('index');
})->name('dashboad');
//Categories
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');

Route::get('/categories/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
Route::post('/categories/{id}/update', [CategoryController::class, 'update'])->name('categories.update');

Route::post('/categories/{id}', [CategoryController::class, 'delete'])->name('categories.delete');

//Articles
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');

Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
Route::post('/articles/store', [ArticleController::class, 'store'])->name('articles.store');

Route::get('/articles/{id}', [ArticleController::class, 'edit'])->name('articles.edit');
Route::post('/articles/{id}/update', [ArticleController::class, 'update'])->name('articles.update');

Route::post('/articles/{id}', [ArticleController::class, 'delete'])->name('articles.delete');

//Users
Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users/store', [UserController::class, 'store'])->name('users.store');

Route::get('/users/{id}', [UserController::class, 'edit'])->name('users.edit');
Route::post('/users/{id}/update', [UserController::class, 'update'])->name('users.update');

Route::post('/users/{id}', [UserController::class, 'delete'])->name('users.delete');

//Permissions
Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');

Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
Route::post('/permissions/store', [PermissionController::class, 'store'])->name('permissions.store');

Route::get('/permissions/{id}', [PermissionController::class, 'edit'])->name('permissions.edit');
Route::post('/permissions/{id}/update', [PermissionController::class, 'update'])->name('permissions.update');

Route::post('/permissions/{id}', [PermissionController::class, 'delete'])->name('permissions.delete');

//Roles
Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');

Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
Route::post('/roles/store', [RoleController::class, 'store'])->name('roles.store');

Route::get('/roles/{id}', [RoleController::class, 'edit'])->name('roles.edit');
Route::post('/roles/{id}/update', [RoleController::class, 'update'])->name('roles.update');

Route::post('/roles/{id}', [RoleController::class, 'delete'])->name('roles.delete');

//
Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
