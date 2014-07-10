<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::group(array('before' => 'csrf'), function(){
    
    Route::post('/post/{id}/upvote',['as'=>'post-upvote','uses'=>'VoteController@postUpvotePost']);
    Route::post('/post/{id}/downvote',['as'=>'post-down','uses'=>'VoteController@postDownvotePost']);
    
    Route::post('/comment/submit/{postId}',['as'=>'comment-submit','uses'=>'CommentController@postSubmit']);
    Route::post('/comment/{id}/upvote',['as'=>'comment-upvote','uses'=>'VoteController@postUpvoteComment']);
    Route::post('/comment/{id}/downvote',['as'=>'comment-down','uses'=>'VoteController@postDownvoteComment']);
    Route::post('/comment/edit/{commentId}',['as'=>'comment-edit','uses'=>'CommentController@postEdit']);
    
    
    
});

Route::group(array('before' => 'admin'), function(){
    Route::get('admin/flagged/posts',['as'=>'admin-flagged-posts','uses'=>'AdminController@getFlaggedPosts']);
    Route::get('admin/flagged/comments',['as'=>'admin-flagged-comments','uses'=>'AdminController@getFlaggedComments']);
    Route::get('admin/',['as'=>'admin-default','uses'=>'AdminController@getDefault']);
});

Route::group(array('before' => 'auth'), function(){
    
    Route::group(array('before' => 'post.owner'), function(){
        Route::group(array('before' => 'csrf'), function(){
            Route::post('/post/edit/{postId}-{postSlug}',['as'=>'post-edit','uses'=>'PostController@postEditPost']);
        });
        Route::get('/post/edit/{postId}-{postSlug}',['as'=>'post-edit','uses'=>'PostController@getEditPost']);
        
    });
    
    Route::group(array('before' => 'community.owner'), function(){
        Route::group(array('before' => 'csrf'), function(){
            Route::post('/community/{communitySlug}/edit',['as'=>'community-edit','uses'=>'CommunityController@postEditCommunity']);
        });
        Route::get('/community/{communitySlug}/edit',['as'=>'community-edit','uses'=>'CommunityController@getEditCommunity']);
        
    });
    
    Route::group(array('before' => 'csrf'), function(){
        
        Route::post('post/submit',['as'=>'post-submit','uses'=>'PostController@postSubmit']);
        Route::post('/user/{username}/settings',['as'=>'user-settings','uses'=>'UserController@postUserSettings']);
        
        Route::post('community/{id}/subscribe',['as'=>'community-subscribe','uses'=>'CommunityController@postSubscribe']);
        Route::post('community/{id}/unsubscribe',['as'=>'community-unsubscribe','uses'=>'CommunityController@postUnsubscribe']);
        Route::post('communities/create',['as'=>'communities-create','uses'=>'CommunityController@postCreate']);
        
        Route::post('favorites/add',['as'=>'favorites-add','uses'=>'FavoriteController@postAdd']);
        Route::post('favorites/remove',['as'=>'favorites-remove','uses'=>'FavoriteController@postRemove']);
        
        Route::post('flag/spam/post',['as'=>'flags-spam-post','uses'=>'FlagController@postReportPostAsSpam']);
        Route::post('flag/spam/comment',['as'=>'flags-spam-comment','uses'=>'FlagController@postReportCommentAsSpam']);

    });
    
    Route::get('post/submit',['as'=>'post-submit','uses'=>'PostController@getSubmit']);
    
    Route::get('account/logout',array('as'=>'account-logout','uses'=> 'AccountController@getLogout'));
    
    Route::get('user/{username}/settings',['as'=>'user-settings','uses'=>'UserController@getUserSettings']);
    
    Route::get('notifications',['as'=>'notifications-browse','uses'=>'NotificationController@getBrowse']);
    
    Route::get('communities/create',['as'=>'communities-create','uses'=>'CommunityController@getCreate']);
    
    Route::get('/post/browse/favorites',array('as'=>'post-browse-favorites','uses'=> 'PostController@getFavorites'));
    Route::get('/post/browse/discover',array('as'=>'post-browse-discover','uses'=> 'PostController@getDiscover'));
    
    });

Route::group(array('before' => 'guest'), function(){
    
    Route::get('/twitter-login',array(
            'as' =>'twitter-login',
            'uses' => 'AccountController@getTwitterLogin'
        ));
    
    Route::group(array('before' => 'csrf'), function(){
        
        Route::post('/account/create',array(
            'as' =>'account-create',
            'uses' => 'AccountController@postCreate'
        ));
        
        Route::post('/account/login',[
            'as'=>'account-login',
            'uses' => 'AccountController@postLogin'
        ]);
        
        Route::post('/account/recover-password',array(
        'as' => 'account-recover-password',
        'uses' => 'AccountController@postRecoverPassword'
        ));
        
        
        

    });
    
    Route::get('/account/recover-password/{code}',array(
    'as'=> 'account-recover-password',
    'uses' => 'AccountController@getRecoverPassword'
    ));
    
    Route::get('/account/activate/{code}',array(
        'as' => 'account-activate',
        'uses' => 'AccountController@getActivate'
    ));
    
    
    
//    Route::get('/account/forgot-password',array(
//        'as' => 'account-forgot-password',
//        'uses' => 'AccountController@getForgotPassword'
//    ));
    

    
    
    Route::get('/account/login',['as'=>'account-login','uses' => 'AccountController@getIndex']);
    Route::get('/account/register',['as'=>'account-register','uses' => 'AccountController@getIndex']);

});

Route::get('community/{communitySlug}',['as'=>'community-view','uses'=>'CommunityController@getViewCommunity']);
Route::get('community/{communitySlug}/top',['as'=>'community-view-top','uses'=>'CommunityController@getViewCommunityTop']);
Route::get('community/{communitySlug}/new',['as'=>'community-view-new','uses'=>'CommunityController@getViewCommunityRecent']);

Route::get('communities/browse',['as'=>'communities-browse','uses'=>'CommunityController@getBrowse']);
Route::get('communities/browse/recent',['as'=>'communities-browse-recent','uses'=>'CommunityController@getMostRecent']);
Route::get('communities/browse/active',['as'=>'communities-browse-active','uses'=>'CommunityController@getMostActive']);

Route::get('search/posts',['as'=>'search-default','uses'=>'SearchController@getSearchPosts']);
/*Route::get('search/comments/{keyword}',['as'=>'search-comments','uses'=>'SearchController@getSearchComments']);
Route::get('search/users/{keyword}',['as'=>'search-users','uses'=>'SearchController@getSearchUsers']);
*/


Route::get('/user/{username}',array(
    'as'=>'user-index','uses'=>'UserController@getIndex'
    ));

Route::get('/user/{username}/posts',array(
    'as'=>'user-posts','uses'=>'UserController@getPosts'
    ));

Route::get('/user/{username}/comments',array(
    'as'=>'user-comments','uses'=>'UserController@getComments'
    ));

Route::get('/post/view/{postId}-{postSlug}',['as'=>'post-view','uses'=>'PostController@getView']);


Route::get('/post/browse/top',array(
    'as'=>'post-browse-top','uses'=> 'PostController@getTop'
    ));

Route::get('/post/browse/popular',array(
    'as'=>'post-browse-popular','uses'=> 'PostController@getMostPopular'
    ));

Route::get('/post/browse/new',array(
    'as'=>'post-browse-new','uses'=> 'PostController@getMostRecent'
    ));

//Route::get('/contact',array('as'=>'contact','uses'=> 'HomeController@getContact'));
Route::get('/privacy',array('as'=>'privacy','uses'=> 'HomeController@getPrivacy'));
Route::get('/terms',array('as'=>'terms','uses'=> 'HomeController@getTerms'));
Route::get('/faq',array('as'=>'faq','uses'=> 'HomeController@getFAQ'));
Route::get('/about',array('as'=>'about','uses'=> 'HomeController@getAbout'));

Route::get('/go/{id}',array('as'=>'shortlink','uses'=> 'HomeController@getShortLink'));

//Route::get('/',function(){
////    echo gethostname();
////    return App::environment();
//   
//   
//   
//   
//
//
//
//
//
//    
//});
Route::get('/',array('as'=>'default','uses'=> 'PostController@getDefault'));







    


