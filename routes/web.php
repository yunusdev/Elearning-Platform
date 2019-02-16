<?php

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


Auth::routes();
//Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/logout', function (){

   auth()->logout();

   return redirect('/');

});

Route::namespace('User')->group(function (){

    Route::get('/', 'IndexController@welcome')->name('welcome');

    Route::middleware('auth')->group(function () {

        Route::get('/profile', 'ProfilesCOntroller@index')->name('profile');

        Route::get('/series/{series}', 'SeriesController@index')->name('series');

        Route::get('/series/{series}/learn', 'SeriesController@startLearning')->name('series.learning');

        Route::get('/series/{series}/lesson/{lesson}', 'LessonController@index')->name('lesson.watch');

        Route::post('/lesson/{lesson}/complete', 'LessonController@completeLesson')->name('lesson.complete');

    });


});

Route::prefix('admin')->namespace('Admin')->middleware('admin')->group(function (){

    Route::resource('/series', 'SeriesController');

    Route::resource('/{series_by_id}/lessons', 'LessonController');

});







//Route::get('test', function()
//{
//    dd(Config::get('mail'));
//});