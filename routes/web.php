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

use App\Genre;
use App\Http\Resources\GenreResource;
use App\Http\Resources\SerieResource;
use App\Serie;

// Les ressources
Auth::routes();
Route::resource('serie', 'SerieController')->middleware('auth');
Route::resource('episode', 'EpisodeController')->middleware('auth');
Route::resource('comment', 'CommentController')->middleware('auth');

//Route commentaire
Route::get('/comment/create/{id}', 'CommentController@create')->name('comment.create');
Route::post('/comment/store', 'CommentController@store')->name('comment.store');
Route::any('comment/{id}/edit', function (){
    return view('CommentController@edit', '{{id}}');
})->name('comment.edit');
Route::get('/serie/{id}/valide', 'CommentController@valide')->name('commentaireValide');
Route::get('/serie/{id}/unvalide', 'CommentController@unvalide')->name('commentaireUnvalide');

// Route homepage
//Route::get('/', 'SerieController@index')->name('home');
Route::get('home', 'MainController@index')->name('home');
Route::get('/', 'MainController@index')->name('home');
Route::get('/serie', 'SerieController@index')->name('serie');
// Route serie
Route::get('/serie/{id}', function (){
    return view('SerieController@show', '{{id}}');
})->middleware('auth')->name('serie.show');
Route::get('/avis/create','SerieController@adAvis')->middleware('is_admin')->name('adAvis');
// Route seen
Route::get('episode.hasSeenEpisode', 'EpisodeController@hasSeenEpisode')->middleware('auth')->name('hasSeenEpisode');
Route::get('saison/seen', 'SerieController@hasSeenSeason')->middleware('auth')->name('hasSeenSeason');
Route::get('serie.hasSeenSerie', 'SerieController@hasSeenSerie')->middleware('auth')->name('hasSeenSerie');
// Route saison
Route::get('/saison','EpisodeController@index')->middleware('auth')->name('episode.index');
Route::get('/episode/{id}', function (){
    return view('EpisodeController@show', '{{id}}');
})->middleware('auth')->name('episode.show');

// Compte gestion
Route::get('/compte', 'UserController@modifComp')->middleware('auth')->name('compte');
Route::get('/stats', 'UserController@stats')->middleware('auth')->name('stats');
Route::post('/avatar/update', 'UserController@update')->name('user.update');

// A ne pas modifier, routes admin
Route::get('/admin', 'AdminController@index')->middleware('is_admin')->name('admin');
Route::get('/admin/users', 'AdminController@members')->middleware('is_admin')->name('admin.members');
Route::post('/admin/members/update', 'AdminController@update')->middleware('is_admin')->name('member.update');


