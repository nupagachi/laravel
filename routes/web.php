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
//start login-logout

Route::middleware('beforelogin')->group(function () {

    Route::get('/', function () {
        return redirect('/login');
    });
    Route::get('/login', function () {
        return view('login.index');
    })->name('login');
    Route::post('login', 'LoginController@login');

});
Route::get('/logout', 'LoginController@logout')->name('logout');
//Route::get('/register','LoginController@index')->name('register');
//Route::post('/register','LoginController@create')->name('create');

Route::middleware(['checklogin'])->group(function () {

    Route::middleware(['checkrole'])->group(function () {

        Route::prefix('admin')->group(function () {
            Route::get('/', 'AdminController@getAll')->name('admin.index');
            Route::get('add', function () {
                return ' man hinh them moi user';
            });
            Route::get('/edit/{id}', 'AdminController@edit')->name('admin.edit');
            Route::post('/edit/{id}', 'AdminController@post')->name('admin.post');
            Route::get('/delete/{id}','AdminController@delete')->name('admin.delete');
            Route::get('/create','AdminController@create')->name('admin.create');
            Route::post('/create','AdminController@store')->name('admin.store');
            Route::get('/profile','AdminController@profile')->name('admin.profile');
            Route::post('/postprofile','AdminController@postProfile')->name('admin.post.profile');
            Route::get('/search','AdminController@search')->name('admin.search');
        });
    });

    Route::middleware(['checkroleuser'])->group(function () {
        Route::prefix('user')->group(function () {
            Route::get('/', 'UserController@getAll')->name('user.index');
            Route::get('/edit/{id}', 'UserController@edit')->name('user.edit');
            Route::post('/edit/{id}', 'UserController@post')->name('user.post');
            Route::get('/profile','UserController@profile')->name('user.profile');
            Route::post('/profile','UserController@postProfile')->name('user.post.profile');
            Route::get('/search','UserController@search')->name('user.search');
        });
    });

});
Route::get('/delay',function (){
   return view('login.delay');
});
Route::get('/check',function (){
   return view('error.check');
});

//End logout-login
//start Manager-admin


