<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Article\ArticleController;
use App\Http\Controllers\Article\CommentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Product\ProductCommentController;
use App\Http\Controllers\ResultController;

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

Route::get('/admin', [AdminController::class, 'admin']);

Route::get('/users-list', [AdminController::class, 'usersList']);

Route::get('/users-list/approve/{id}', [AdminController::class, 'approve']);

Route::get('/articles/add', [ArticleController::class, 'add']);

Route::post('/articles/add', [
  ArticleController::class,
  'create'
]);

Route::get('/articles/delete/{id}', [
  ArticleController::class,
  'delete'
]);

Route::get('/', [ArticleController::class, 'index']);

Route::get('/articles', [ArticleController::class, 'index']);

Route::get('/articles/detail/{id}', [
  ArticleController::class,
  'detail'
]);

Route::get('/articles/edit/{id}', [
  ArticleController::class, 'edit'
]);

Route::post('/articles/edit/{id}', [
  ArticleController::class, 'update'
]);

Route::post('/comments/add', [
  CommentController::class,
  'create']
);

Route::get('/comments/delete/{id}', [
  CommentController::class,
  'delete'
]);

Route::get('/products', [
  ProductController::class,
  'products'
]);

Route::get('/products/detail/{id}', [
  ProductController::class, 
  'detail'
]);

Route::get('/products/add', [
  ProductController::class,
  'add'
]);

Route::post('/products/add', [
  ProductController::class,
  'create'
]);

Route::get('/products/delete/{id}', [
  ProductController::class, 
  'delete'
]);

Route::get('/products/edit/{id}', [
  ProductController::class, 
  'edit'
]);

Route::get('/products/edit/{id}', [
  ProductController::class, 
  'edit'
]);

Route::post('/products/edit/{id}', [
  ProductController::class, 
  'update'
]);

Route::get('/categories', [
  CategoryController::class,
  'index'
]);

Route::get('/categories/add', [
  CategoryController::class,
  'add'
]);

Route::post('/categories/add', [
  CategoryController::class,
  'create'
]);

Route::get('/categories/detail/{id}', [
  CategoryController::class,
  'detail'
]);

Route::post('/product-comments/add', [
  ProductCommentController::class,
  'create'
]);

Route::get('/product-comments/delete/{id}', [
  ProductCommentController::class,
  'delete'
]);

Route::post('/articles/results', [
  ResultController::class,
  'articles'
]);

Route::post('/products/results', [
  ResultController::class,
  'products'
]);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');