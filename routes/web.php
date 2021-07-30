<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('questions','App\Http\Controllers\QuestionsController')->except('show');

Route::get('/questions/{slug}','App\Http\Controllers\QuestionsController@show')->name('questions.show');

Route::resource('questions.answers','App\Http\Controllers\AnswersController')->except(['index','create','show']);

Route::post('answers/{answer}/accept','App\Http\Controllers\AcceptAnswerController')->name('answers.accept');

Route::post('questions/{question}/favourites','App\Http\Controllers\FavouriteController@store')->name('questions.favourites');

Route::delete('questions/{question}/favourites','App\Http\Controllers\FavouriteController@destroy')->name('questions.unfavourite');