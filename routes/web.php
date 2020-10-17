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


//frontEnd Routes


use Illuminate\Support\Facades\Auth;

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
//Route::get('/', 'HomeController@index')->name('home');
Route::post('/search', 'HomeController@search')->name('search');

Route::get('comp_regist/{user_id}','Auth\RegisterController@showComRegist');
Route::post('comp_regist','Auth\RegisterController@storeComRegist');

Route::group(['middleware' => ['check.user']], function () {

    Route::get('/', ['uses' => 'HomeController@CheckIfLogin']);

    Route::get('/register', ['uses' => 'Auth\RegisterController@showRegistrationForm', 'as' => 'register']);
    Route::post('get/cities', 'HomeController@getCountryCities');
    Route::post('get/govareas', 'HomeController@getCountryGovareas');


    Route::get('index', 'HomeController@index');

    Route::get('/login', '\App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');


//places Routes
    Route::get('/places', 'PlacesController@showPublicPlaces')->name('places');
    Route::get('/about', 'IndexController@showabout')->name('about');
    Route::get('/FQA', 'IndexController@showfqa')->name('fqa');
    Route::get('/conditions', 'IndexController@showconditions')->name('conditions');


///////////////////////////////////////////////////////////////


    Auth::routes();
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/gallary', 'MediaController_front@showPublicMedia')->name('home');
    Route::get('/gallary-details/{id}', 'MediaController_front@showPublicMediaDetails')->name('gallary-details');
    Route::get('/video-details/{id}', 'MediaController_front@showPublicVideoDetails')->name('Video-details');

//verification mail Routes
    Route::get('verifyEmailFirst/{role_id}', 'Auth\RegisterController@verifyEmailFirst')->name('verifyEmailFirst');
    Route::get('verify/{email},{verifyToken}', 'Auth\RegisterController@sendEmailDone')->name('sendEmailDone');

// match Routes
//Route::resource('matchs', 'MatchController_front');
//Route::get('matchs/show/details/{id}', 'MatchController_front@showMatchDetails');

    Route::get('/match', 'MatchController_front@showPublicMatch')->name('match');
    Route::get('/match-details/{id}', 'MatchController_front@showPublicMatchDetails')->name('match-details');
    Route::get('/league-details/{id}', 'MatchController_front@showPublicLeagueDetails')->name('league-details');

// sports Routes
    Route::resource('sports', 'SportController_front');

// news Routes
    Route::resource('news', 'NewsController_front');
    Route::get('news/show/details/{id}', 'NewsController_front@showNewDetails')->name('health-details');

    Route::get('/health', 'NewsController_front@showPublichealth')->name('health');
//Route::get('/health-details/{id}', 'NewsController_front@showPublichealthDetails')->name('health-details');

//teams Routes
    Route::resource('teams', 'TeamController_front');
    Route::get('/teams/join/{id}', 'TeamController_front@joinTeam');
    Route::get('/teams/disJoin/{id}', 'TeamController_front@disJoinTeam');
    Route::get('/teams/delete/user/{team_id}/{user_id}', 'TeamController_front@deleUser');
    Route::post('/teams/add/group', 'TeamController_front@addTeamGroup');
    Route::get('/teams_profile', 'TeamController_front@showTeamProfile');

//events Routes
    Route::resource('events', 'EventController_front');
    Route::post('/events/create', 'EventController_front@storeEvent');


//contactUs Routes
// Route::get('/contacts', 'contactUsController_front@showContact');
// Route::post('/contacts/send/mail', 'contactUsController_front@sendContactMail');


//contactUs Routes
    Route::get('/contacts', 'contactUsController_front@showContact');
    Route::post('/contacts/send/mail', 'contactUsController_front@sendContactMail');
    Route::post('/contacts/SendToMail', [
        'uses' => 'contactUsController_front@SendToMail',
        'as' => 'SendToMail'

    ]);

});

Route::group(['middleware' => ['auth', 'check.user']], function () {
    //group Routes
    Route::resource('groups', 'GroupController_front');
    Route::post('/groups/team_members', 'GroupController_front@getTeamMembers');
    Route::post('/news/add_comment', 'NewsController_front@add_comment');
    Route::get('/groups/join/{id}', 'GroupController_front@joinGroup');
    Route::get('/groups/disJoin/{id}', 'GroupController_front@disJoinGroup');
    Route::get('/groups/delete/user/{group_id}/{user_id}', 'GroupController_front@deleUser');

    // media Routes
    Route::resource('media', 'MediaController_front');

    // article Routes
    //Route::resource('articles', 'ArticleController_front');
    // article Routes
    Route::resource('articles', 'ArticleController_front');
    Route::get('/article-details/{id}', 'ArticleController_front@showUserArticleDetails')->name('article-details');

    Route::post('/article/add/reply/{article_id}/{comment_id}', 'ArticleController_front@addReply');
    Route::delete('article/delete/comment/{article_id}/{comment_id}', 'ArticleController_front@deleteComment');
    Route::post('/article/add/comment/{article_id}', 'ArticleController_front@addComment');
    Route::post('/article/edit/comment/', 'ArticleController_front@editComment');

    Route::get('/activation', 'ArticleController_front@showActivationPage')->name('activation');
    Route::post('/activation/add', 'ArticleController_front@storeActivationData');


    //events Routes
    Route::get('/events/join/{id}', 'EventController_front@joinEvent');
    Route::get('/events/disJoin/{id}', 'EventController_front@disJoinEvent');
    Route::post('/events/add/reply/{event_id}/{comment_id}', 'EventController_front@addReply');
    Route::post('/events/edit/comment/', 'EventController_front@editComment');
    Route::delete('events/delete/comment/{event_id}/{comment_id}', 'EventController_front@deleteComment');
    Route::post('/events/add/comment/{event_id}', 'EventController_front@addComment');
    Route::get('/events_profile', 'EventController_front@showEventProfile');


    //news Routes
    Route::post('/news/add/reply/{new_id}/{comment_id}', 'NewsController_front@addReply');
    Route::delete('news/delete/comment/{new_id}/{comment_id}', 'NewsController_front@deleteComment');
    Route::post('/news/add/comment/{new_id}', 'NewsController_front@addComment');
    Route::post('/news/edit/comment/', 'NewsController_front@editComment');

    //profile
    Route::get('update/profile', 'ProfileController@showUpdateProfile');
    Route::put('update/profile/{id}', 'ProfileController@UpdateProfileInfo');
    Route::get('profile/preview/{id}', 'ProfileController@showProfilePreview');
    Route::get('personal/info', 'ProfileController@showPersonalInfo');


    //news Routes
    Route::post('/news/add/reply/{new_id}/{comment_id}', 'NewsController_front@addReply');
    Route::delete('news/delete/comment/{new_id}/{comment_id}', 'NewsController_front@deleteComment');
    Route::post('/news/add/comment/{new_id}', 'NewsController_front@addComment');
    Route::post('/news/edit/comment/', 'NewsController_front@editComment');

    //matches Routes
    Route::post('/matches/add/reply/{match_id}/{comment_id}', 'MatchController_front@addReply');
    Route::delete('matches/delete/comment/{match_id}/{comment_id}', 'MatchController_front@deleteComment');
    Route::post('/matches/add/comment/{match_id}', 'MatchController_front@addComment');
    Route::post('/matches/edit/comment/', 'MatchController_front@editComment');

    //health Routes
    Route::post('/health/add/reply/{new_id}/{comment_id}', 'NewsController_front@addReply2');
    Route::delete('health/delete/comment/{new_id}/{comment_id}', 'NewsController_front@deleteComment2');
    Route::post('/health/add/comment/{new_id}', 'NewsController_front@addComment2');
    Route::post('/health/edit/comment/', 'NewsController_front@editComment2');

    //gallery Routes
    Route::post('/gallery/add/reply/{media_id}/{comment_id}', 'MediaController_front@addReply');
    Route::delete('gallery/delete/comment/{media_id}/{comment_id}', 'MediaController_front@deleteComment');
    Route::post('/gallery/add/comment/{media_id}', 'MediaController_front@addComment');
    Route::post('/gallery/edit/comment/', 'MediaController_front@editComment');

    //video Routes
    Route::post('/video/add/reply/{media_id}/{comment_id}', 'MediaController_front@addReply2');
    Route::delete('video/delete/comment/{media_id}/{comment_id}', 'MediaController_front@deleteComment2');
    Route::post('/video/add/comment/{media_id}', 'MediaController_front@addComment2');
    Route::post('/video/edit/comment/', 'MediaController_front@editComment2');

    //league Routes
    Route::post('/league/add/reply/{league_id}/{comment_id}', 'LeaguesController@addReply');
    Route::delete('league/delete/comment/{league_id}/{comment_id}', 'LeaguesController@deleteComment');
    Route::post('/league/add/comment/{league_id}', 'LeaguesController@addComment');
    Route::post('/league/edit/comment/', 'LeaguesController@editComment');

    //message Routes
    Route::get('messages', 'MessageController_front@index');

    //request Routes
    Route::get('requests', 'ProfileController@showRequests');
    Route::get('/groups/approve/{group_id}/{user_id}', 'ProfileController@approveGroupJoin');
    Route::get('/groups/remove/{group_id}/{user_id}', 'ProfileController@removeGroupJoin');

    Route::get('/teams/approve/{team_id}/{user_id}', 'ProfileController@approveTeamJoin');
    Route::get('/teams/remove/{team_id}/{user_id}', 'ProfileController@removeTeamJoin');

    Route::get('/events/approve/{event_id}/{user_id}', 'ProfileController@approveEventJoin');
    Route::get('/events/remove/{event_id}/{user_id}', 'ProfileController@removeEventJoin');

    //notifications routes
    Route::get('markAsRead', 'NotificationController@markAsReaded');
    Route::get('clicked/{id}', 'NotificationController@visitedLink');

});

