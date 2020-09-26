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

Route::post('replyChild/{id}', 'ReplyChildController@store');
Route::get('replychild/{id}', 'ReplyChildController@index');
Route::delete('replychildren/{id}', 'ReplyChildController@destroy');
/**
** The routes for comment report
*/
Route::post('{slug}/sendReport', 'ReportController@create');
//Thread search
Route::get('/xf/search', ['as' => '/xf/search', 'uses' => 'SearchController@show']);
Route::get('/thread/{id}/edit', 'ThreadsController@edit');
Route::post('/thread/{thread}/edit', 'ThreadsController@update'); 
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

//Replies\
Route::post('{slug}/create', 'RepliesController@store')->name('reply.create');
Route::get('{slug}/replies', 'ThreadsController@replies')->name('replies');

Route::patch('/commentEdit/{id}', ['as' => '/commentEdit/{id}', 'uses' => 'RepliesController@update']);
Route::get('/comment/like/{id}', ['as' => '/comment/like/{id}', 'uses' => 'likesController@togglelikes']);


//notifications
Route::get('/user/{user}/notifications', 'UserNotificationsController@index');
Route::get('/user/notifications/markasread', 'UserNotificationsController@markasread')->name('/user/notifications/markasread');
Route::delete('/user/{user}/notifications/{id}', 'UserNotificationsController@destroy');

//Forum routes
Route::get('/forum/{slug}', ['as' => 'forum/{slug}', 'uses' => 'ThreadsController@forums']);
Route::get('/xf/forums', 'forumsController@forum');
#...............Administration...................
//Users
Route::get('admin/dashboard', 'adminController@dashboard')->name('admin')->middleware('auth');
Route::get('admin/users', 'adminController@users')->name('admin/users')->middleware('auth');
Route::get('search', 'adminController@search')->name('search')->middleware('auth');
Route::get('admin/{user}/edit', ['as'=> '{user}/edit', 'uses' => 'adminController@edit'])->middleware('auth');
Route::get('admin/users/deleted', ['as'=>'users/deleted', 'uses'=>'adminController@deleted'])->middleware('auth');
Route::get('admin/users/{id}/restore', 'adminController@restore')->name('admin/users/{id}/restore')->middleware('auth');
Route::put('admin/update', ['as'=> 'admin/update', 'uses' => 'adminController@update'])->middleware('auth');
Route::get('admin/ban_search', 'adminController@search_ban')->name('admin/ban_search')->middleware('auth');
Route::delete('admin.destroy/{id}', ['as' => 'admin.destroy', 'uses' => 'adminController@destroy'])->middleware('auth');
Route::get('admin/new', function(){return view('Admin.new_user');});
Route::put('admin/store', ['as' => 'admin/store', 'uses' => 'adminController@store'])->middleware('auth');
//roles
Route::get('admin/role', ['as' => 'admin/role', 'uses' => 'RolesController@role'])->middleware('auth');
Route::post('admin/role', 'RolesController@storeRole')->name('admin/role');
Route::get('admin/roles', ['as' => 'admin/roles', 'uses' => 'RolesController@roles'])->middleware('auth');
Route::get('admin/role/{id}/edit', ['as'=>'admin/role/edit', 'uses'=>'RolesController@edit'])->middleware('auth');
Route::put('admin/role/store/{id}', ['as'=>'admin/role/store', 'uses'=>'RolesController@store'])->middleware('auth');
//Admin Forums
Route::get('admin/forums', ['as' => 'admin/forums', 'uses' => 'adminController@view'])->middleware('auth');
Route::put('admin/store/forum', 'adminController@store_forum')->name('admin/store/forum')->middleware('auth');
Route::get('admin/forum/new', ['as' => 'admin/forum/new', 'uses' => 'adminController@new_forum'])->middleware('auth');
Route::get('admin/forum/{forum}/edit', 'adminController@edit_forum')->name('admin/forum/{forum}/edit')->middleware('auth');
Route::put('admin/forum/{forum}/update', ['as' => 'admin/forum/update', 'uses' => 'adminController@update_forum'] )->middleware('auth');
Route::get('admin/forum/removed',['as' => 'admin/forum/removed', 'uses' => 'adminController@removed_threads'])->middleware('auth');
//Categories
Route::get('admin/categories', 'CategoriesController@index')->name('admin/categories')->middleware('auth');
Route::get('admin/categories/create', 'CategoriesController@show')->name('admin/categories/create')->middleware('auth');
Route::put('admin/categories/store', 'CategoriesController@store')->name('admin/categories/store')->middleware('auth');
Route::get('admin/categories/{id}/edit', 'CategoriesController@edit')->name('admin/categories/{id}/edit')->middleware('auth');
Route::put('admin/categories/update/{id}', 'CategoriesController@update')->name('admin/categories/update')->middleware('auth');

#................ Moderation.....................

 Route::get('moderation/{user}/ban', 'ModerationController@ban')->name('moderation/{user}/ban')->middleware('auth');
 Route::get('moderation/revoke/{id}', 'ModerationController@revoke')->name('moderation/revoke/{id}')->middleware('auth');
 Route::post('/moderation', ['as'=>'/moderation', 'uses' => 'ModerationController@store'])->middleware('auth');
 Route::get('moderation/banned', 'ModerationController@banned')->name('moderation/banned')->middleware('auth');
 Route::get('moderation/users', 'ModerationController@users')->name('moderation/users')->middleware('auth');
 Route::get('moderation/search', 'ModerationController@search')->name('moderation/search')->middleware('auth');
 Route::get('/moderation', 'ModerationController@index')->name('/moderation')->middleware('auth');
 Route::get('moderation/reported', 'ModerationController@report')->name('moderation/reported')->middleware('auth');
 Route::get('moderation/user/{user}/edit', ['as'=>'/user/{user}/edit', 'uses' => 'ModerationController@user_edit'])->middleware('auth');
 Route::patch('moderation/update', ['as' => 'moderation/update', 'uses' => 'ModerationController@update']);
 Route::delete('moderation/destroy', ['as' => 'moderation/destroy', 'uses' => 'ModerationController@destroy'])->middleware('auth');

 #-----------Profile-------------------------
 Route::post('/user/follow/{id}', 'ProfileController@follow');
 Route::get('/user/follow/{id}', 'ProfileController@unfollow');
 Route::get('u/{username}',['as' =>'profile', 'uses'=>'ProfileController@show']);
 Route::get('/user/{user}/edit', ['as'=>'user/{user}/edit', 'uses'=>'ProfileController@edit']);
 Route::put('user/update', ['as'=>'user/update', 'uses'=>'ProfileController@update']);
 Route::put('user/pix', ['as'=>'user/pix', 'uses'=>'ProfileController@img']);
 Route::get('user/threads/{user}', 'ProfileController@user_threads')->middleware('auth');
 Route::post('u/{username}/store', 'ProfileController@update')->middleware('auth');
 Route::get('profiles/{user}/activity', 'ProfilesController@index')->name('activity');
 Route::get('profiles/{user}', 'ProfilesController@show');

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
