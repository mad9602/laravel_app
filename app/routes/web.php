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

Route::group(['middleware' => 'auth'], function () {
    Route::resource('games', 'GameController', ['except' => ['destroy']]);
    Route::resource('teams', 'TeamController');
    Route::post('/like', 'LikeController@like');
    Route::post('/delete/{id}/user', 'DeleteController@user_delete')->name('user.delete');

    Route::get('/profile', 'TeamController@profile')->name('teams.profile');
});
//マイページ
