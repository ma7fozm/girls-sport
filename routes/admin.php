<?php

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'check.admin']], function () {

    // Route::get('/', function () {
    //     return view('admin.index');
    // })->name('dashboard');


     Route::resource('/', 'IndexController');


    //Users Routes
    Route::resource('users', 'userController');
    Route::post('get/cities', 'HomeController@getCountryCities');
    Route::post('get/govareas', 'HomeController@getCountryGovareas');

    Route::get('users/block/{id}', 'userController@block');
    Route::get('users/unblock/{id}', 'userController@unblock');
    Route::get('users/show/media/{id}', 'userController@showMedia');


    //Sponsors Route
    Route::resource('Sponsors', 'SponsorsController');
    Route::get('Sponsors/block/{id}', 'SponsorsController@active');
    Route::get('Sponsors/unblock/{id}', 'SponsorsController@unactive');


    //Categories Route
    Route::resource('Categories', 'CategoryController');
    Route::get('Categories/block/{id}', 'CategoryController@active');
    Route::get('Categories/unblock/{id}', 'CategoryController@unactive');

    //Leagues Route
    Route::resource('Leagues', 'LeaguesController');
    Route::get('Leagues/block/{id}', 'LeaguesController@active');
    Route::get('Leagues/unblock/{id}', 'LeaguesController@unactive');


    //Teams Routes
    Route::resource('teams', 'TeamController');
    Route::get('teams/block/{id}', 'TeamController@active');
    Route::get('teams/unblock/{id}', 'TeamController@unactive');
    Route::get('teams/show/media/{id}', 'TeamController@showMedia');

    //Media Routes
    Route::resource('media', 'MediaController');
    Route::get('user/media/create', 'MediaController@createUserMedia');
    Route::get('media/activate/{id}', 'MediaController@active');
    Route::get('/media/unactivate/{id}', 'MediaController@unactive');
    Route::get('/media/add/{id}', 'MediaController@addMedia');
    Route::get('/mediav/add/{id}', 'VideoController@addMedia');
    Route::get('teams/media/add/{id}', 'MediaController@addTeamMedia');
    Route::get('teamsv/media/add/{id}', 'VideoController@addTeamMedia');
    Route::get('teams/show/media', 'MediaController@showTeamMedia');
    Route::get('/teams/media/create', 'MediaController@createTeamMedia');
    Route::get('/teams/media/{id}/edit', 'MediaController@editTeamMedia');
    Route::put('/teams/media/update/{id}', 'MediaController@updateTeamMedia');
    Route::post('/teams/media/', 'MediaController@storeTeamMedia');
    Route::get('groups/show/media', 'MediaController@showGroupMedia');
    Route::get('/groups/media/create', 'MediaController@createGroupMedia');
    Route::post('/groups/media/', 'MediaController@storeGroupMedia');
    Route::get('/groups/media/{id}/edit', 'MediaController@editGroupMedia');
    Route::put('/groups/media/update/{id}', 'MediaController@updateGroupMedia');
    Route::get('/groupsVid/media/create', 'VideoController@createGroupVideo');
    Route::post('/groupsVid/media/', 'VideoController@storeGroupVideo');
    Route::get('/groupsVid/media/{id}/edit', 'VideoController@editGroupVideo');
    Route::put('/groupsVid/media/update/{id}', 'VideoController@updateGroupVideo');
    Route::get('/teamsVid/media/create', 'VideoController@createTeamVideo');
    Route::get('/teamsVid/media/{id}/edit', 'VideoController@editTeamVideo');
    Route::put('/teamsVid/media/update/{id}', 'VideoController@updateTeamVideo');
    Route::post('/teamsVid/media/', 'VideoController@storeTeamVideo');
    Route::resource('video', 'VideoController');
    Route::get('user/video/create', 'MediaController@createUserMedia');

  


    // ---  Media comments --
    Route::get('media/show/comments/{id}', 'MediaController@showMediaComments');
    Route::delete('media/comment/{id}', 'MediaController@deleteMediaComment');
    Route::get('media/comment/block/{id}', 'MediaController@activeComment');
    Route::get('media/comment/unblock/{id}', 'MediaController@unactiveComment');
    // --- replies ---
    Route::get('media/comments/replies/{id}', 'MediaController@showCommentReplies');
    Route::delete('media/comment/reply/{id}', 'MediaController@deleteMediaCommentReply');
    Route::post('media/comment/reply/{id}', 'MediaController@storeMediaReply');
    Route::post('media/comment/addcomment/{id}', 'MediaController@storeMediacomment');


 // ---  League comments --
    Route::get('league/show/comments/{id}', 'LeaguesController@showLeagueComments');
    Route::delete('league/comment/{id}', 'LeaguesController@deleteLeagueComment');
    Route::get('league/comment/block/{id}', 'LeaguesController@activeComment');
    Route::get('league/comment/unblock/{id}', 'LeaguesController@unactiveComment');
    // --- replies ---
    Route::get('league/comments/replies/{id}', 'LeaguesController@showCommentReplies');
    Route::delete('league/comment/reply/{id}', 'LeaguesController@deleteLeagueCommentReply');
    Route::post('league/comment/reply/{id}', 'LeaguesController@storeLeagueReply');
    Route::post('league/comment/addcomment/{id}', 'LeaguesController@storeLeaguecomment');

//    Route::get('league/show/matches/{id}', 'LeaguesController@showLeagueComments');


    //Event Media Routes
    Route::resource('eventMedia', 'EventMediaController');
    Route::get('event/album/', 'EventMediaController@showAlbums');
    Route::get('event/album/create', 'EventMediaController@createAlbum');
    Route::get('event/album/create/{id}', 'EventMediaController@createAlbumforEvent');
    Route::post('event/album/', 'EventMediaController@storeAlbum');
    Route::get('/event/album/{id}/edit', 'EventMediaController@editAlbum');
    Route::put('/event/album/{id}', 'EventMediaController@updateAlbum');
    Route::delete('event/album/{id}', 'EventMediaController@destroyAlbum');
    Route::get('album/activate/{id}', 'EventMediaController@active');
    Route::get('album/unactivate/{id}', 'EventMediaController@unactive');
    Route::get('event/album/show/media/{id}', 'EventMediaController@showMedia');
    Route::get('/eventsVid/media/create', 'VideoController@createeventsVideo');
    Route::get('/eventsVid/media/{id}/edit', 'VideoController@editeventsVideo');
    Route::put('/eventsVid/media/update/{id}', 'VideoController@updateeventsVideo');
    Route::post('/eventsVid/media/', 'VideoController@storeeventsVideo');


    //Group Routes
    Route::resource('groups', 'GroupController');
    Route::post('/groups/team_members', 'GroupController@getTeamMembers');
    Route::get('groups/add/{group_id}/{user_id}/{mem_type}', 'GroupController@add_group_member');
    Route::get('groups/delete/{group_id}/{user_id}', 'GroupController@delete_group_member');
    Route::get('groups/block/{id}', 'GroupController@active');
    Route::get('groups/unblock/{id}', 'GroupController@unactive');
    Route::get('groups/show/media/{id}', 'GroupController@showMedia');
    Route::get('groups/media/add/{id}', 'MediaController@addGroupMedia');
    Route::get('groupsv/media/add/{id}', 'VideoController@addGroupMedia');


    //News Route
    Route::resource('news', 'NewsController');
    Route::get('news/block/{id}', 'NewsController@active');
    Route::get('news/unblock/{id}', 'NewsController@unactive');
    Route::get('news/show/comments/{id}', 'NewsController@showNewsComments');


        // --- comments --
    Route::delete('news/comment/{id}', 'NewsController@deleteNewsComment');
    Route::get('news/comment/block/{id}', 'NewsController@activeComment');
    Route::get('news/comment/unblock/{id}', 'NewsController@unactiveComment');
    // --- replies ---
    Route::get('news/comments/replies/{id}', 'NewsController@showCommentReplies');
    Route::delete('news/comment/reply/{id}', 'NewsController@deleteNewsCommentReply');
    Route::post('news/comment/reply/{id}', 'NewsController@storeNewsReply');
    Route::post('news/comment/addcomment/{id}', 'NewsController@storeNewscomment');


    //places Route
    Route::resource('places', 'PlacesController');
    Route::get('places/block/{id}', 'PlacesController@active');
    Route::get('places/unblock/{id}', 'PlacesController@unactive');

    //articles Route
    Route::resource('articles', 'ArticleController');
    Route::get('articles/block/{id}', 'ArticleController@active');
    Route::get('articles/unblock/{id}', 'ArticleController@unactive');

     Route::get('articles/show/comments/{id}', 'ArticleController@showArticleComments');
    // --- comments --
    Route::delete('articles/comment/{id}', 'ArticleController@deleteArticleComment');
    Route::get('articles/comment/block/{id}', 'ArticleController@activeComment');
    Route::get('articles/comment/unblock/{id}', 'ArticleController@unactiveComment');
    // --- replies ---
    Route::get('articles/comments/replies/{id}', 'ArticleController@showCommentReplies');
    Route::delete('articles/comment/reply/{id}', 'ArticleController@deleteArticleCommentReply');
    Route::post('articles/comment/reply/{id}', 'ArticleController@storeArticleReply');
    Route::post('articles/comment/addcomment/{id}', 'ArticleController@storeArticlecomment');

    //gallary Route
    Route::get('/gallary', 'MediaController@showGallary');
    Route::get('/gallary/create', 'MediaController@createGallary');
    Route::get('/gallary/{id}/edit', 'MediaController@editGallary');
    Route::post('/gallary/store', 'MediaController@storeGallary');
    Route::put('/gallary/update/{id}', 'MediaController@updateGallary');

    Route::get('/gallaryVid/create', 'VideoController@createVidGallary');
    Route::get('/gallaryVid/{id}/edit', 'VideoController@editVidGallary');
    Route::post('/gallaryVid/store', 'VideoController@storeVidGallary');
    Route::put('/gallaryVid/update/{id}', 'VideoController@updateVidGallary');


    // matchs Routes
    Route::resource('matchs', 'MatchController');
    Route::get('league/show/matchs/{id}', 'MatchController@showLegaMatches');
    Route::get('matchs/block/{id}', 'MatchController@active');
    Route::get('matchs/unblock/{id}', 'MatchController@unactive');
    Route::get('match/show/comments/{id}', 'MatchController@showMatchComments');
    // --- comments --
    Route::delete('matchs/comment/{id}', 'MatchController@deleteMatchComment');
    Route::get('matchs/comment/block/{id}', 'MatchController@activeComment');
    Route::get('matchs/comment/unblock/{id}', 'MatchController@unactiveComment');
    // --- replies ---
    Route::get('match/comments/replies/{id}', 'MatchController@showCommentReplies');
    Route::delete('match/comment/reply/{id}', 'MatchController@deleteMatchCommentReply');
    Route::post('match/comment/reply/{id}', 'MatchController@storeMatchReply');


    // sports Routes
    Route::resource('sports', 'SportController');
    Route::get('sports/block/{id}', 'SportController@active');
    Route::get('sports/unblock/{id}', 'SportController@unactive');


    // events Routes
    Route::resource('events', 'EventsController');
    Route::get('events/block/{id}', 'EventsController@active');
    Route::get('events/unblock/{id}', 'EventsController@unactive');
    Route::get('event/show/comments/{id}', 'EventsController@showEventComments');
    Route::get('event/show/albums/{id}', 'EventsController@showEventAlbums');
    Route::post('/event/albums', 'EventsController@getEventAlbums');
    // --- comments --
    Route::delete('events/comment/{id}', 'EventsController@deleteEventComment');
    Route::get('events/comment/block/{id}', 'EventsController@activeComment');
    Route::get('events/comment/unblock/{id}', 'EventsController@unactiveComment');
    // --- replies ---
    Route::get('events/comments/replies/{id}', 'EventsController@showCommentReplies');
    Route::delete('events/comment/reply/{id}', 'EventsController@deleteEventCommentReply');
    Route::post('events/comment/reply/{id}', 'EventsController@storeEventReply');


    //Messages Routes
    Route::resource('messages', 'MessageController');
    Route::get('messages/add/ReplyMsg/{id}', 'MessageController@addReplyMessage');
    Route::get('messages/show/replies/{id}', 'MessageController@showReplyMessage');

    // notification routes
    Route::get('markAsRead','NotificationController@markAsReaded');
    Route::get('clicked/{id}','NotificationController@visitedLink');

    //request routes
    Route::get('request','RequestController@showRequests');
    Route::get('/events/approve/{event_id}/{user_id}', 'ProfileController@approveEventJoin');
    Route::get('/events/remove/{event_id}/{user_id}', 'ProfileController@removeEventJoin');


});

