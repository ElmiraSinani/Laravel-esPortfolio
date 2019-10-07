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

Route::get('/', function () {
    return view('frontend.welcome');
});

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('/dashboard/posts', ["uses"=>"Admin\AdminPostsController@index", "as"=> "adminDisplayPosts"]);
Route::get('/dashboard/tags', ["uses"=>"DashboardController@showAllTags", "as"=> "adminDisplayTags"]);
Route::get('/dashboard/images', ["uses"=>"DashboardController@showAllImages", "as"=> "adminDisplayImages"]);

/*GET Requests for posts*/
//create post Form
Route::get('/dashboard/post/create', ["uses"=>"Admin\AdminPostsController@create", "as"=> "AdminCreatePost"]);
//show edit form by id
Route::get('/dashboard/post/edit/{id}', ["uses"=>"Admin\AdminPostsController@edit", "as"=> "AdminEditPost"]);
//delete post by id
Route::get('/dashboard/post/delete/{id}', ["uses"=>"Admin\AdminPostsController@delete", "as"=> "AdminDeletePost"]);

/*POST Requests for posts*/
//insert post from create form
Route::post('/dashboard/post/insert', ["uses"=>"Admin\AdminPostsController@insert", "as"=> "AdminInsertPost"]);
//update post by id
Route::post('/dashboard/post/update/{id}', ["uses"=>"Admin\AdminPostsController@update", "as"=> "AdminUpdatePost"]);



Route::post('/ajax/tags', ["uses"=>"Admin\AdminTagsController@getAjaxTags", "as"=> "GetAjaxTags"]);



//https://appdividend.com/2018/05/31/laravel-dropzone-image-upload-tutorial-with-example/
//https://appdividend.com/2018/02/05/laravel-multiple-images-upload-tutorial/