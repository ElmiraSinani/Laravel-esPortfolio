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

/***** Dashboard Posts *******/
//show all posts
Route::get('/dashboard/posts', ["uses"=>"Admin\AdminPostsController@index", "as"=> "adminDisplayPosts"]);
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


/***** Dashboard Tags *******/
//show all tags
Route::get('/dashboard/tags', ["uses"=>"Admin\AdminTagsController@index", "as"=> "adminDisplayTags"]);
/*GET Requests for posts*/
//create post Form
Route::get('/dashboard/tag/create', ["uses"=>"Admin\AdminTagsController@create", "as"=> "AdminCreateTag"]);
//show edit form by id
Route::get('/dashboard/tag/edit/{id}', ["uses"=>"Admin\AdminTagsController@edit", "as"=> "AdminEditTag"]);
//delete post by id
Route::get('/dashboard/tag/delete/{id}', ["uses"=>"Admin\AdminTagsController@delete", "as"=> "AdminDeleteTag"]);
/*POST Requests for posts*/
//insert post from create form
Route::post('/dashboard/tag/insert', ["uses"=>"Admin\AdminTagsController@insert", "as"=> "AdminInsertTag"]);
//update post by id
Route::post('/dashboard/tag/update/{id}', ["uses"=>"Admin\AdminTagsController@update", "as"=> "AdminUpdateTag"]);

/******* Ajax Get All Tags *******/
Route::post('/ajax/tags', ["uses"=>"Admin\AdminTagsController@getAjaxTags", "as"=> "GetAjaxTags"]);



/***** Dashboard Images *******/
//show all images
Route::get('/dashboard/images', ["uses"=>"Admin\AdminImagesController@index", "as"=> "adminDisplayImages"]);
/*GET Request for Image */
//show create form 
Route::get('/dashboard/image/create', ["uses"=>"Admin\AdminImagesController@create", "as"=> "AdminCreateImage"]);
//show edit form by id
Route::get('/dashboard/image/edit/{id}', ["uses"=>"Admin\AdminImagesController@edit", "as"=> "AdminEditImage"]);
//delete post by id
Route::get('/dashboard/image/delete/{id}', ["uses"=>"Admin\AdminImagesController@delete", "as"=> "AdminDeleteImage"]);
/*POST Requests for images*/
//insert post from create form
Route::post('/dashboard/image/insert', ["uses"=>"Admin\AdminImagesController@insert", "as"=> "AdminInsertImage"]);
//update post by id
Route::post('/dashboard/post/update/{id}', ["uses"=>"Admin\AdminImagesController@update", "as"=> "AdminUpdateImage"]);
