<?php
use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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



Route::get('/articles/search', [ArticleController::class, 'search'])->name('articles.search');

Route::get('articles/{article}/delete', [ArticleController::class, 'delete'])
    ->name('articles.delete');

Route::resource('articles', ArticleController::class);    

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

