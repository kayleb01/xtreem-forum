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
/**
** The routes for the front end
*/

//Thread search
 Route::get('/xf/search', ['as' => '/xf/search', 'uses' => 'SearchController@show']);

Route::get('/', 'ThreadsController@index')->name('/'); 
Route::get('/home', 'ThreadsController@index')->name('home');
Route::get('/{thread}', ['as' => '/{thread}', 'uses' => 'ThreadsController@show']);
Route::get('xf/modify/{id}', ['as' => 'xf/modify/{id}', 'uses' => 'RepliesController@edir']);
Route::get('forum/{id}/create', ['as' => 'forum/{id}/create', 'uses' => 'ThreadsController@create']);
Route::put('xf/store', 'ThreadsController@store')->name('xf/store');
Route::get('xf/featured/{id}', 'ThreadsController@make_fp')->name('xf/featured/{id}');
Route::get('xf/lock/{id}', 'LockedThreadsController@store')->name('xf/lock/{id}');
Route::get('xf/unlock/{id}', 'LockedThreadsController@destroy')->name('xf/unlock/{id}');
Route::delete('xf/thread/{id}', 'threadsController@destroy');
Route::get('xf/{thread}/subscriptions', 'ThreadSubscriptionsController@store');
Route::delete('xf/{thread}/subscriptions ', 'ThreadSubscriptionsController@destroy');
Route::delete('/xf/destroy/{id}/comment', 'RepliesController@destroy')->name('/xf/destroy/{id}/comment');

//Replies
Route::get('{slug}/replies', 'ThreadsController@replies')->name('{slug}/replies');
Route::post('xf/reply/{id}', ['as' => 'xf/reply/{id}', 'uses' => 'RepliesController@store']);
Route::get('/commentEdit/{id}', ['as' => '/commentEdit/{id}', 'uses' => 'RepliesController@AjaxEdit']);
Route::get('/comment/like/{id}', ['as' => '/comment/like/{id}', 'uses' => 'likesController@togglelikes']);


//notifications
Route::get('/user/{user}/notifications', 'UserNotificationsController@index');
Route::get('/user/notifications/markasread', 'UserNotificationsController@markasread')->name('/user/notifications/markasread');
Route::get('/user/notification/{id}', 'UserNotificationsController@destroy');

//Forum routes
Route::get('/forum/{slug}', ['as' => 'forum/slug', 'uses' => 'ThreadsController@forums']);
Route::get('/xf/forums', 'forumsController@forum');
#...............Administration...................
//Users
Route::get('admin/dashboard', 'adminController@dashboard')->name('admin');
Route::get('admin/users', 'adminController@users')->name('admin/users');
Route::get('search', 'adminController@search')->name('search');
Route::get('admin/{user}/edit', ['as'=> '{user}/edit', 'uses' => 'adminController@edit']);
Route::get('admin/users/deleted', ['as'=>'users/deleted', 'uses'=>'adminController@deleted']);
Route::get('admin/users/{id}/restore', 'adminController@restore')->name('admin/users/{id}/restore');
Route::put('admin/update', ['as'=> 'admin/update', 'uses' => 'adminController@update']);
Route::get('admin/ban_search', 'adminController@search_ban')->name('admin/ban_search');
Route::delete('admin.destroy/{id}', ['as' => 'admin.destroy', 'uses' => 'adminController@destroy']);
Route::get('admin/new', function(){return view('Admin.new_user');});
Route::put('admin/store', ['as' => 'admin/store', 'uses' => 'adminController@store']);
//roles
Route::get('admin/role', ['as' => 'admin/role', 'uses' => 'RolesController@role']);
Route::post('admin/create', ['as'=>'admin/create', 'uses'=>'RolesController@create']);
Route::get('admin/roles', ['as' => 'admin/roles', 'uses' => 'RolesController@roles']);
Route::get('admin/role/{id}/edit', ['as'=>'admin/role/edit', 'uses'=>'RolesController@edit']);
Route::put('admin/role/store/{id}', ['as'=>'admin/role/store', 'uses'=>'RolesController@store']);
//Admin Forums
Route::get('admin/forums', ['as' => 'admin/forums', 'uses' => 'adminController@view']);
Route::put('admin/store/forum', 'adminController@store_forum')->name('admin/store/forum');
Route::get('admin/forum/new', ['as' => 'admin/forum/new', 'uses' => 'adminController@new_forum']);
Route::get('admin/forum/{forum}/edit', 'adminController@edit_forum')->name('admin/forum/{forum}/edit');
Route::put('admin/forum/{forum}/update', ['as' => 'admin/forum/update', 'uses' => 'adminController@update_forum'] );
Route::get('admin/forum/removed',['as' => 'admin/forum/removed', 'uses' => 'adminController@removed_threads']);
//Categories
Route::get('admin/categories', 'CategoriesController@index')->name('admin/categories');
Route::get('admin/categories/create', 'CategoriesController@show')->name('admin/categories/create');
Route::put('admin/categories/store', 'CategoriesController@store')->name('admin/categories/store');
Route::get('admin/categories/{id}/edit', 'CategoriesController@edit')->name('admin/categories/{id}/edit');
Route::put('admin/categories/update/{id}', 'CategoriesController@update')->name('admin/categories/update');

#................ Moderation.....................

 Route::get('moderation/{user}/ban', 'ModerationController@ban')->name('moderation/{user}/ban');
 Route::get('moderation/revoke/{id}', 'ModerationController@revoke')->name('moderation/revoke/{id}');
 Route::post('/moderation', ['as'=>'/moderation', 'uses' => 'ModerationController@store']);
 Route::get('moderation/banned', 'ModerationController@banned')->name('moderation/banned');
 Route::get('moderation/users', 'ModerationController@users')->name('moderation/users');
 Route::get('moderation/search', 'ModerationController@search')->name('moderation/search');
 Route::get('/moderation', 'ModerationController@index')->name('/moderation');
 Route::get('moderation/reported', 'ModerationController@report')->name('moderation/reported');
 Route::get('moderation/user/{user}/edit', ['as'=>'/user/{user}/edit', 'uses' => 'ModerationController@user_edit']);
 Route::patch('moderation/update', ['as' => 'moderation/update', 'uses' => 'ModerationController@update']);
 Route::delete('moderation/destroy', ['as' => 'moderation/destroy', 'uses' => 'ModerationController@destroy']);

 #-----------Profile-------------------------
 Route::get('user/{username}',['as' =>'profile', 'uses'=>'ProfileController@show'] );
 Route::get('/user/{user}/edit', ['as'=>'user/{user}/edit', 'uses'=>'ProfileController@edit']);
 Route::put('user/update', ['as'=>'user/update', 'uses'=>'ProfileController@update']);
 Route::put('user/pix', ['as'=>'user/pix', 'uses'=>'ProfileController@img']);
 Route::get('user/threads/{user}', 'ProfileController@user_threads');
 Route::get('profiles/{user}/activity', 'ProfileController@index')->name('activity');
 Route::get('profiles/{user}', 'ProfileController@show1')->name('profile');

 #..........Pages
 Route::get('admin/pages', 'pagesController@index')->name('admin/pages');
 Route::get('admin/pages/add', 'pagesController@show')->name('admin/pages/add');
 Route::post('admin/pages/store', 'pagesController@store')->name('admin/pages/store');
 Route::get('admin/pages/{id}/edit', 'pagesController@edit')->name('admin/pages/{id}/edit');
 Route::put('admin/pages/update/{id}', 'pagesController@update')->name('admin/pages/update');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('api/users', 'Api\UsersController@index')->name('api.users');
Route::get('api/channels', 'Api\ChannelsController@index');


Route::get('/home', 'HomeController@index')->name('home');
