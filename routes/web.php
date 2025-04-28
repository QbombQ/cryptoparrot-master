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

Route::get('/portfolios/create-main-for-all', 'AdminSubsystem\PortfoliosController@createMainPortfoliosForAll');

Route::prefix('admin')->middleware('admin')->namespace('AdminSubsystem')->group(function () {

    Route::get('/', 'MainPageController@main');
    Route::get('/update-handles', 'MainPageController@updateHandles');
    Route::get('/reset-redeems', 'MainPageController@resetRedeems');
    Route::get('/lowercase-emails', 'MainPageController@lowercaseEmails');
    Route::get('/update-trade-pair-ids', 'MainPageController@updateTradePairIds');
    Route::get('/target-to-open', 'MainPageController@targetToOpen'); 

    /* Articles */
    Route::paginate('/articles', 'ArticlesPageController@main');
    Route::get('/articles/new', 'ArticlePageController@main');
    Route::get('/articles/{slug}/edit', 'ArticlePageController@edit');
    Route::post('/articles/{slug}/edit', 'ArticlePageController@update');
    Route::post('/articles/new', 'ArticlePageController@create');
    Route::get('/articles/{articleId}/delete', 'ArticlePageController@delete')->where('articleId', '[0-9]+');

    /* Categories */
    Route::paginate('/categories', 'CategoriesPageController@main');
    Route::get('/categories/new', 'CategoryPageController@main');
    Route::post('/categories/new', 'CategoryPageController@create');
    Route::get('/categories/{categoryId}/edit', 'CategoryPageController@edit')->where('categoryId', '[0-9]+');
    Route::post('/categories/{categoryId}/edit', 'CategoryPageController@update')->where('categoryId', '[0-9]+');
    Route::get('/categories/{categoryId}/delete', 'CategoryPageController@delete')->where('categoryId', '[0-9]+');

    /* Currencies */
    Route::paginate('/currencies', 'CurrenciesPageController@main');
    Route::get('/currencies/new', 'CurrencyPageController@main');
    Route::post('/currencies/new', 'CurrencyPageController@create');
    Route::get('/currencies/{currencyId}/edit', 'CurrencyPageController@edit')->where('currencyId', '[0-9]+');
    Route::post('/currencies/{currencyId}/edit', 'CurrencyPageController@update')->where('currencyId', '[0-9]+');
  
    /* Trades */
    Route::paginate('/trades', 'TradesPageController@main'); 
    Route::get('/trades/updateTrades', 'TradesPageController@updateTrades');
    Route::get('/trades/{tradeId}/edit', 'TradesPageController@edit')->where('tradeId', '[0-9]+'); 
    Route::post('/trades/{tradeId}/edit', 'TradesPageController@update')->where('tradeId', '[0-9]+');  

    /* Trade pairs */
    Route::paginate('/pairs', 'PairsPageController@main');
    Route::get('/pairs/new', 'PairPageController@main');
    Route::get('/pairs/{pairId}/edit', 'PairPageController@edit')->where('pairId', '[0-9]+');  
    Route::post('/pairs/{pairId}/edit', 'PairPageController@update')->where('pairId', '[0-9]+');  
    Route::post('/pairs/new', 'PairPageController@create');

    /* Users */
    Route::paginate('/users', 'UsersPageController@main');
    Route::get('/users/mass-email', 'UsersPageController@massEmail'); 
    Route::get('/users/activity/today', 'UsersPageController@activityToday'); 
    Route::get('/users/activity/this-week', 'UsersPageController@activityThisWeek'); 
    Route::get('/users/mass-notifications', 'UsersPageController@massNotifications'); 
    Route::get('/users/resend-verification', 'UsersPageController@resendVerification'); 
    Route::post('/users/mass-email', 'UsersPageController@sendMassEmail');    
    Route::post('/users/mass-notifications', 'UsersPageController@sendMassNotifications');    
    Route::get('/users/{handle}/edit', 'UsersPageController@edit');  
    Route::get('/users/{id}/reset', 'UsersPageController@reset')->where('id', '[0-9]+');   
    Route::get('/users/{id}/delete', 'UsersPageController@delete')->where('id', '[0-9]+');   
    Route::get('/users/{id}/ban', 'UsersPageController@ban')->where('id', '[0-9]+');   
    Route::get('/users/{id}/unban', 'UsersPageController@unban')->where('id', '[0-9]+');   
    Route::get('/users/{handle}/view', 'UsersPageController@view'); 
    Route::get('/users/{handle}/check', 'UsersPageController@checkBalances'); 
    Route::post('/users/edit', 'UserPageController@edit');

    /* Badges */
    Route::paginate('/badges', 'BadgesPageController@main');
    Route::get('/badges/new', 'BadgesPageController@new');
    Route::post('/badges/new', 'BadgesPageController@create');
    Route::get('/badges/{badgeId}/edit', 'BadgesPageController@edit')->where('badgeId', '[0-9]+'); 
    Route::post('/badges/{badgeId}/edit', 'BadgesPageController@update')->where('badgeId', '[0-9]+');    
    Route::post('/badges/give', 'BadgesPageController@give');

    Route::paginate('/exchanges', 'ExchangesPageController@main');

    /* Invitations */
    Route::paginate('/invited-users', 'InvitedUsersPageController@main');    

    /* Rewards */
    Route::paginate('/rewards', 'RewardsPageController@main');
    Route::paginate('/user-rewards', 'RewardsPageController@userRewards');
    Route::get('/rewards/new', 'RewardsPageController@new');
    Route::post('/rewards/new', 'RewardsPageController@create');
    Route::post('/user-rewards/update', 'RewardsPageController@updateUserReward');
    Route::get('/rewards/{rewardId}/edit', 'RewardsPageController@edit')->where('rewardId', '[0-9]+'); 
    Route::post('/rewards/{rewardId}/edit', 'RewardsPageController@update')->where('rewardId', '[0-9]+');
    Route::get('/rewards/{rewardId}/delete', 'RewardsPageController@delete')->where('rewardId', '[0-9]+');

    /* Sponsors */
    Route::paginate('/sponsors', 'SponsorsPageController@main');
    Route::get('/sponsors/new', 'SponsorsPageController@new');
    Route::post('/sponsors/new', 'SponsorsPageController@create');
    Route::get('/sponsors/{sponsorId}/edit', 'SponsorsPageController@edit')->where('sponsorId', '[0-9]+'); 
    Route::post('/sponsors/{sponsorId}/edit', 'SponsorsPageController@update')->where('sponsorId', '[0-9]+');
    Route::get('/sponsors/{sponsorId}/delete', 'SponsorsPageController@delete')->where('sponsorId', '[0-9]+');

    /* EarnPlayDollars */
    Route::paginate('/earnPlayDollars', 'EarnPlayDollarsPageController@main');
    Route::get('/earnPlayDollars/new', 'EarnPlayDollarsPageController@new');
    Route::post('/earnPlayDollars/new', 'EarnPlayDollarsPageController@create');
    Route::get('/earnPlayDollars/{dollarId}/edit', 'EarnPlayDollarsPageController@edit')->where('dollarId', '[0-9]+'); 
    Route::post('/earnPlayDollars/{dollarId}/edit', 'EarnPlayDollarsPageController@update')->where('dollarId', '[0-9]+');
    Route::get('/earnPlayDollars/{dollarId}/delete', 'EarnPlayDollarsPageController@delete')->where('dollarId', '[0-9]+');

    /* Competitions */
    Route::paginate('/competitions', 'CompetitionsPageController@main');
    Route::get('/competitions/new', 'CompetitionPageController@main');
    Route::post('/competitions/new', 'CompetitionPageController@create');
    Route::post('/competitions/register', 'CompetitionPageController@register');
    Route::get('/competitions/{competitionId}/edit', 'CompetitionPageController@edit')->where('competitionId', '[0-9]+');
    Route::post('/competitions/{competitionId}/edit', 'CompetitionPageController@update')->where('competitionId', '[0-9]+');
    Route::get('/competitions/generate-portfolios', 'CompetitionsPageController@generatePortfolios');

    Route::post('/files/upload', 'FilesController@uploadCkEditorFile');
    Route::get('/portfolios/create-main-for-all', 'PortfoliosController@createMainPortfoliosForAll');
    
}); 

Route::prefix('')->namespace('FrontSubsystem')->group(function () {

    Route::get('/etoro', function() {

        return redirect('http://partners.etoro.com/B4658_A79102_TClick.aspx', 302);

    });

    Route::get('/visit/tradeor', function() {

        return redirect('https://tradeor.com/?refid=033a52e5&cmp=001', 302);

    });

    Route::get('/binance', function() {

        return redirect('https://www.binance.com/en/register?ref=SJT9YXIF', 302);

    });

    Route::get('/bitfinex', function() {

        return redirect('https://www.bitfinex.com/?refcode=7t_E_07iX', 302);

    }); 

    Route::get('/ospreyfx', function() {

        return redirect('https://www.ospreyfx.com/?cmp=1f1e1a2s&refid=1777', 302);

    }); 

    Route::get('/beaxy', function() {

        return redirect('https://beaxy.com/registration?code=EZLX2ANWTE', 302);

    });

    Route::get('/give-early-adopter', 'MainPageController@giveEarlyAdopter');
    Route::get('/unsubscribe-newsletter/{token}', 'ActionsController@unsubscribeNewsletter');
 
    Route::get('/invite/{handle}', 'MainPageController@invited');

    Route::get('/banned', 'PagesController@banned');

    /* Pages */
    Route::get('/', 'MainPageController@main'); 
    Route::get('/mobile/home', 'MainPageController@mobileHome'); 
    Route::get('/privacy-policy', 'PagesController@privacyPolicy');
    Route::get('/tos', 'PagesController@termsOfService'); 

    if(env('APP_FORK') == 'cryptoparrot'){
         Route::get('/crypto-moon', 'PagesController@cryptoMoon');
    } 

    Route::get('/about', 'PagesController@about');
    Route::get('/unsubscribe', 'PagesController@unsubscribe');
    Route::get('/organizations', 'PagesController@organizations');
    Route::get('/careers', 'PagesController@careers');
    Route::get('/faq', 'PagesController@faq');
    Route::get('/disclaimer', 'PagesController@disclaimer'); 
    Route::get('/partnerships', 'PagesController@partnerships');
    Route::get('/success', 'PagesController@success');
    Route::get('/contact', 'PagesController@contact');
    Route::get('/login', 'PagesController@loadLoginView')->middleware('guest');
    Route::get('/forgot-password', 'PagesController@loadRecoverPasswordView');
    Route::get('/pick-your-handle', 'PagesController@pickYourHandle')->middleware('auth')->middleware('noUsernameOrEmail');  
      
    /* Registration */
    Route::post('/register', 'RegistrationController@register')->middleware('guest');
    Route::get('/registerWithRedirect', 'RegistrationController@registerWithRedirect')->middleware('guest');
    Route::get('/social/{socialNetwork}', 'LoginController@loginWith')->where('socialNetwork', 'facebook|twitter|google|reddit|steemit|discord');
    Route::get('/callback/{socialNetwork}', 'LoginController@finishLoginWithSocialMedia'); 

    /* Verification */
    Route::get('/verify/{token}', 'RegistrationController@verify');
    //Route::get('/pre-verify/', 'RegistrationController@preVerify');    

    /* Pick username/email */
    Route::post('/pick-your-handle', 'RegistrationController@reserveHandle')->middleware('auth');

    /* Contacts page */
    Route::post('/contact', 'ActionsController@sendMessage'); 

    /* Share with friends */
    Route::post('/shareWithFriends', 'ActionsController@shareWithFriends');

    /* Register */
    Route::get('/signup', 'RegistrationController@loadSignUpScreen')->middleware('guest');

    /* Login */
    Route::post('/login', 'LoginController@loginWithEmail')->middleware('guest');
    Route::get('/logout', 'ActionsController@logout')->middleware('auth'); 

    /* Password reset */
    Route::post('/forgot-password', 'ActionsController@recoverPassword');
    Route::get('/recover/{token}', 'ActionsController@loadChangePasswordView');
    Route::post('/change-password', 'ActionsController@changePassword');

    Route::get('/goal/{code}',function() {

        return redirect('/', 301);

    });

    Route::get('/bitcoin-graveyard',function() {

        return redirect('/', 301);

    }); 
    
    Route::get('/competition/{code}', 'ActionsController@addRefCodeToCookie');
    Route::get('/ref/{code}', 'ActionsController@addRefCodeToCookieAndRedirectHome');

});

Route::prefix('')->namespace('FrontSubsystem')->middleware('throttle')->group(function () {

    /* Cron jobs */
    Route::get('/update-currencies', 'ActionsController@updateCurrencies');
    Route::get('/update-currencies-average', 'ActionsController@updateCurrenciesAverage');
    Route::get('/update-balances', 'ActionsController@updateBalances');
    Route::get('/update-historical-portfolio-values', 'ActionsController@updateHistoricalPortfolioValues');
    Route::get('/remove-duplicates-historical-portfolio-values', 'ActionsController@removeDuplicatesHistoricalPortfolioValues');

    /* Pages */
    Route::get('/maintenance', 'MaintenancePageController@main');
    Route::post('/maintenance', 'MaintenancePageController@login');

}); 

Route::prefix('/app')->middleware(['auth', 'usernameExists', 'notBanned'])->namespace('TradeSubsystem')->group(function () {
 
    Route::get('current-portfolio-html', 'ActionsController@getCurrentPortfolioHtml');

    Route::get('/load-invited-users', 'ActionsController@loadInvitedUsers');
    Route::get('/mention-data', 'ActionsController@getMentionData');
    Route::get('/search-data', 'ActionsController@getSearchData');

    Route::get('/trade', 'MainPageController@redirectFromTrade');

    /* Pages */
    Route::get('/', 'MainPageController@main');
    Route::get('/welcome', 'MainPageController@main');
    Route::paginate('/feed', 'FeedPageController@load');
    Route::get('/settings', 'SettingsPageController@main');
    Route::paginate('/top-traders/lifetime', 'TopTradersPageController@lifetime');
    Route::paginate('/top-traders/days7', 'TopTradersPageController@days7');
    Route::paginate('/top-traders/days30', 'TopTradersPageController@days30');
    Route::paginate('/my-trades', 'TradePageController@myTrades');  
    Route::get('/load-notifications', 'NotificationsPageController@get');
    Route::get('/messages', 'PagesController@messages')->middleware('verified'); 
    Route::get('/messages/{id}', 'PagesController@chat')->where('id', '[0-9]+')->middleware('verified'); 
    Route::post('/messages/{id}', 'ConversationsController@sendMessage')->where('id', '[0-9]+')->middleware('verified'); 
    Route::post('/messages/{id}/load', 'ConversationsController@paginateMessages')->where('id', '[0-9]+')->middleware('verified'); 

    /* Competitions */
    Route::get('/competitions/{competitionId}/participate', 'CompetitionsPageController@participate')->where('competitionId', '[0-9]+');
    Route::post('/competitions/{competitionId}/participate', 'CompetitionsPageController@participate')->where('competitionId', '[0-9]+');
 
    /* Settings updates */
    Route::post('/settings/profile', 'SettingsPageController@updateProfile');
    Route::post('/settings/social', 'SettingsPageController@updateSocialLinks');
    Route::post('/settings/notifications', 'SettingsPageController@updateNotifications');
    Route::post('/settings/verification', 'VerificationPageController@updateVerification');
    Route::post('/settings/password', 'SettingsPageController@updatePassword');
    Route::post('/settings/upload/avatar', 'SettingsPageController@updateAvatar');
    Route::post('/settings/upload/cover', 'SettingsPageController@updateCover');
    Route::post('/settings/upload/temp/cover', 'SettingsPageController@uploadTempCover');

    Route::post('/portfolios/create', 'PortfoliosController@create');
    Route::post('/portfolios/change-current-portfolio', 'PortfoliosController@updateCurrentPortfolio');

    /* Trade actions */
    Route::get('/trade/{id}/cancel', 'TradePageController@cancelTrade')->where('id', '[0-9]+');
    Route::get('/trade/{id}/close', 'TradePageController@closeTrade')->where('id', '[0-9]+');
    Route::post('/trade', 'TradePageController@placeTrade');
    Route::post('/trade/limit', 'TradePageController@limitExceeded');
    Route::post('/trades/edit/{tradeId}', 'TradePageController@updateTrade')->where('id', '[0-9]+');

    /* Various actions */
    Route::post('/save-pair/{pairId}', 'ActionsController@savePair')->where('pairId', '[0-9]+');
    Route::post('/read-notifications', 'ActionsController@readNotifications');
    Route::get('/vote-up/{userId}/{tradeId}', 'ActionsController@voteUpTrade')->where('userId', '[0-9]+')->where('tradeId', '[0-9]+');
    Route::get('/vote-down/{userId}/{tradeId}', 'ActionsController@voteDownTrade')->where('userId', '[0-9]+')->where('tradeId', '[0-9]+');
    Route::get('/vote-up/trade-comment/{userId}/{commentId}', 'ActionsController@voteUpTradeComment')->where('userId', '[0-9]+')->where('commentId', '[0-9]+');
    Route::get('/vote-down/trade-comment/{userId}/{commentId}', 'ActionsController@voteDownTradeComment')->where('userId', '[0-9]+')->where('commentId', '[0-9]+');
    Route::get('/vote-up/article-comment/{userId}/{commentId}', 'ActionsController@voteUpArticleComment')->where('userId', '[0-9]+')->where('commentId', '[0-9]+');
    Route::get('/vote-down/article-comment/{userId}/{commentId}', 'ActionsController@voteDownArticleComment')->where('userId', '[0-9]+')->where('commentId', '[0-9]+');    
    Route::post('/post/trade-comment', 'ActionsController@placeTradeComment')->middleware('verified');
    Route::post('/post/article-comment', 'ActionsController@placeArticleComment')->middleware('verified');
    Route::get('/trades/update-visibility', 'ActionsController@updateTradeVisibility');
    Route::get('/load/payment-methods', 'ActionsController@loadPaymentMethods');

    /* Notifications */  
    Route::paginate('notifications', 'NotificationsPageController@main');

    Route::get('/filters/turn-on-my-feed-mode', 'ActionsController@turnOnMyFeedMode');
    Route::get('/filters/turn-off-my-feed-mode', 'ActionsController@turnOffMyFeedMode');

    Route::get('/settings/verification', function() {
        return redirect('/app/verification', 301);
    });

    /* Conversations */
    Route::get('/conversations/{id}', 'ConversationsController@create')->where('id', '[0-9]+');

    Route::get('/block-user/{id}', 'ActionsController@blockUser')->where('id', '[0-9]+');
    Route::get('/unblock-user/{id}', 'ActionsController@unblockUser')->where('id', '[0-9]+');

    Route::get('/blocked-users', 'BlockedUsersPageController@main');

    /* Lessons */
    Route::paginate('/lessons', 'LessonsPageController@main');
    Route::get('/lessons/{id}', 'LessonsPageController@view')->where('id', '[0-9]+');
    Route::paginate('/my-lessons', 'LessonsPageController@myLessons');
    Route::get('/my-lessons/add', 'LessonsPageController@newLesson')->middleware('teacher');
    Route::get('/lessons/{id}/edit', 'LessonsPageController@editLesson')->middleware('teacher'); 
    Route::post('/lessons/{id}/edit', 'LessonsPageController@updateLesson')->middleware('teacher'); 
    Route::post('/my-lessons/add', 'LessonsPageController@createLesson')->middleware('teacher');
    Route::post('/lessons/attachment', 'LessonsPageController@attach')->middleware('teacher');
    Route::post('/lessons/attachment/delete', 'LessonsPageController@deAttach')->middleware('teacher');
    Route::post('/lessons/buy/{id}', 'LessonsPageController@buy');    

    Route::get('earn-play-dollars', 'EarnPlayDollarsPageController@main');
    Route::get('reward-history', 'RewardsPageController@myRewards');
    Route::post('rewards/buy/{id}', 'RewardsPageController@buy')->where('id', '[0-9]+');

    Route::get('/portfolios/close/{portfolioId}', 'PortfoliosController@close')->where('portfolioId', '[0-9]+');

    Route::get('/trade/load/{tradeId}', 'TradePageController@loadTrade')->where('tradeId', '[0-9]+');

});

Route::prefix('')->namespace('TradeSubsystem')->middleware('throttle')->group(function () {

    Route::get('/app/resend-confirmation-link', 'ActionsController@resendConfirmationLink');
    Route::post('/app/exchanges/callback', 'ExchangesPageController@exchangeCallback');

}); 

Route::prefix('')->middleware(['usernameExists', 'notBanned'])->namespace('TradeSubsystem')->group(function () {

    Route::get('app/users/search', 'ActionsController@searchForUsers');
    Route::get('verification-required', 'PagesController@verificationRequired');

    Route::paginate('app/competitions', 'CompetitionsPageController@main');
    Route::paginate('app/competitions/{competitionId}', 'CompetitionsPageController@single')->where('competitionId', '[0-9]+');
    Route::get('app/competitions/start', 'CompetitionsPageController@start');
    Route::get('app/competitions/end', 'CompetitionsPageController@end');
    Route::get('app/competitions/updateParticipants', 'CompetitionsPageController@updateParticipants');

    Route::get('app/earn-money', 'PagesController@earnMoney');    
    Route::get('app/leaderboard', 'TopTradersPageController@main');


    if(env('APP_FORK') == 'fxparrot'){

        Route::get('app/markets', 'CryptoCurrenciesController@main'); 
        Route::get('app/markets/{acronym}', 'CryptoCurrenciesController@single'); 

    }else{ 

        Route::get('app/cryptocurrencies', 'CryptoCurrenciesController@main'); 
        Route::get('app/cryptocurrencies/{acronym}', 'CryptoCurrenciesController@single'); 

    }
   
    Route::paginate('app/rewards', 'RewardsPageController@main');
    Route::post('app/exchanges', 'ExchangesPageController@exchange');

    /* Articles */

    Route::get('/news', function(){ 
        return Redirect::to('/articles', 301); 
    });

    Route::get('/news/{slug}', function($slug){ 
        return Redirect::to('/article/'.$slug, 301); 
    }); 

    Route::get('/news/category/{category}', function($category){ 
        return Redirect::to('/articles/'.$category, 301); 
    });

    Route::paginate('/articles', 'PagesController@articles'); 
    Route::paginate('/articles/{category}', 'PagesController@category');
    Route::get('/article/{slug}', 'PagesController@article');



    Route::get('{slug}', function($slug){
        return Redirect::to('/user/'.$slug, 301);
    });

    Route::get('/user/{slug}', 'ProfilePageController@main')->name('profile');

    Route::paginate('{slug}/followers', 'ProfilePageController@followers');
    Route::paginate('{slug}/followings', 'ProfilePageController@followings');  
    Route::paginate('{slug}/trades', 'ProfilePageController@load');
    Route::get('{slug}/became-patron', 'ProfilePageController@becamePatron');
    Route::get('{slug}/trade/{tradeId}', 'ProfilePageController@trade')->where('tradeId', '[0-9]+');

    Route::paginate('load-more/trade-comments/{tradeId}', 'ActionsController@loadMoreComments')->where('tradeId', '[0-9]+');
    Route::get('load-more/trade-comment-replies/{commentId}', 'ActionsController@loadAllReplies')->where('commentId', '[0-9]+'); 

    Route::paginate('load-more/article-comments/{articleId}', 'ActionsController@loadMoreComments')->where('articleId', '[0-9]+');
    Route::get('load-more/article-comment-replies/{commentId}', 'ActionsController@loadAllReplies')->where('commentId', '[0-9]+'); 

    Route::post('/source-metadata', 'ActionsController@getSourceMetadata'); 
    Route::post('/source-video-iframe', 'ActionsController@getSourceVideoIframe');
    
    Route::get('/app/follow-someone', 'FollowController@followSomeone')->middleware('auth');
    Route::get('/app/follow/{userId}', 'ActionsController@follow')->where('userId', '[0-9]+')->middleware('auth');
    Route::get('/app/unfollow/{userId}', 'ActionsController@unfollow')->where('userId', '[0-9]+')->middleware('auth');     

}); 


