<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', [ 'as' => 'home' , 'uses' => 'HomeController@index' ] );

Route::post('/auth/register',[ 'as' => 'auth.register' , 'uses' => 'Auth\AuthController@postRegister' ]);
Route::get('/auth/login',[ 'as' => 'auth.login' , 'uses' => 'Auth\AuthController@getLogin' ]);
Route::get('/auth/logout',[ 'as' => 'auth.logout' , 'uses' => 'Auth\AuthController@getLogout' ]);
Route::get('/auth/register',[ 'as' => 'auth.register' , 'uses' => 'Auth\AuthController@getRegister' ]);

/*Routes for books*/
Route::get('/book/{id}',[ 'as' => 'book.show' , 'uses' => 'BooksController@show' , 'middleware' => 'auth' ]);
Route::get('/book/read/{id}',[ 'as' => 'book.read' , 'uses' => 'BooksController@read' , 'middleware' => 'auth' ]);
Route::post('/book/return/{id}',[ 'as' => 'book.return' , 'uses' => 'BooksController@returnBook' , 'middleware' => ['auth'] ]);
Route::get('/books/manage',[ 'as' => 'books.manage' , 'uses' => 'BooksController@manage' , 'middleware' => ['auth','admin'] ]);
Route::get('/book/delete/{id}',[ 'as' => 'book.delete' , 'uses' => 'BooksController@destroy' , 'middleware' => ['auth','admin'] ]);
Route::post('/book/store',[ 'as' => 'book.store' , 'uses' => 'BooksController@store' , 'middleware' => ['auth','admin'] ]);
Route::get('/book/edit/{id}',[ 'as' => 'book.edit' , 'uses' => 'BooksController@edit' , 'middleware' => ['auth','admin'] ]);
Route::post('/book/update/{id}',[ 'as' => 'book.update' , 'uses' => 'BooksController@update' , 'middleware' => ['auth','admin'] ]);
/*Routes for books*/

/*Routes for authors*/
Route::get('/authors/manage',[ 'as' => 'authors.manage' , 'uses' => 'AuthorsController@manage' , 'middleware' => ['auth','admin'] ]);
Route::post('/authors/store',[ 'as' => 'author.store' , 'uses' => 'AuthorsController@store' , 'middleware' => ['auth','admin'] ]);
Route::get('/authors/delete/{id}',[ 'as' => 'author.destroy' , 'uses' => 'AuthorsController@destroy' , 'middleware' => ['auth','admin'] ]);
Route::get('/authors/edit/{id}',[ 'as' => 'author.edit' , 'uses' => 'AuthorsController@edit' , 'middleware' => ['auth','admin'] ]);
Route::post('/authors/update/{id}',[ 'as' => 'author.update' , 'uses' => 'AuthorsController@update' , 'middleware' => ['auth','admin'] ]);
/*Routes for authors*/

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
