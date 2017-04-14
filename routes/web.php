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

Route::group(['prefix' => 'questions'], function () {
    Route::get('index', 'QuestionController@index');
    Route::post('save', 'QuestionController@store');
    Route::get('get/{id}', 'QuestionController@get');
    Route::put('update/{id}', 'QuestionController@update');
    Route::delete('delete/{id}', 'QuestionController@destroy');
});

Route::group(['prefix' => 'answers'], function () {
    Route::get('index', 'AnswerController@index');
    Route::post('save', 'AnswerController@store');
    Route::get('get/{id}', 'AnswerController@get');
    Route::put('update/{id}', 'AnswerController@update');
    Route::delete('delete/{id}', 'AnswerController@destroy');
});
