<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['prefix' => 'user'],function()
{
   Route::get('/list','UserController@index')->name('user_list')->middleware('auth');
//    Route::get('/show/{id}','UserController@showUser')->name('show_user')->middleware('auth');    not required right now but we can use it in future
//    Route::get('/edit/{id}','UserController@editUser')->name('edit_user')->middleware('can:edit-user,user');  not required right now but we can use it in future
//    Route::get('/update','UserController@updateUser')->name('update_user')->middleware('can:update-user,user');   not required right now but we can use it in future
   Route::get('/delete/{id}','UserController@deleteUser')->name('delete_user')->middleware('can:delete-user');
   Route::get('/logout/{id}','UserController@forceLogout')->name('force_logout')->middleware('can:force-logout');

   Route::get('/edit-pic','UserController@editPic')->name('edit-pic')->middleware('auth');
   Route::post('/update-avatar','UserController@UpdateAvatar')->name('update-avatar')->middleware('can:update-user');

});
