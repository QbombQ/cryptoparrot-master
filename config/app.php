<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services your application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => env('APP_DEBUG', false),

    'debug_blacklist' => [
        '_COOKIE' => array_keys($_COOKIE),
        '_SERVER' => array_keys($_SERVER),
        '_ENV' => array_keys($_ENV),        
    ],    

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    'url' => env('APP_URL', 'https://cryptoparrot.com'),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => 'UTC',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => [

        Kawankoding\Fcm\FcmServiceProvider::class,

        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Notifications\NotificationServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\Redis\RedisServiceProvider::class,
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,
        Intervention\Image\ImageServiceProvider::class,

        \SocialiteProviders\Manager\ServiceProvider::class,
        'Buzz\LaravelGoogleCaptcha\CaptchaServiceProvider', 
        SocialiteProviders\Generators\GeneratorsServiceProvider::class,
        Dongm2ez\Mention\MentionServiceProvider::class,
        \Torann\GeoIP\GeoIPServiceProvider::class,


        /*
         * Facade Providers
         */

        App\Model\Providers\Facades\BalanceFacadeProvider::class, 
        App\Model\Providers\Facades\NumberFacadeProvider::class, 
        App\Model\Providers\Facades\MediaFacadeProvider::class, 
        App\Model\Providers\Facades\PaginationFacadeProvider::class, 
        App\Model\Providers\Facades\StringsFacadeProvider::class, 
        App\Model\Providers\Facades\FeedFacadeProvider::class, 
        App\Model\Providers\Facades\CurrencyFacadeProvider::class, 
        App\Model\Providers\Facades\TimeFacadeProvider::class, 

        /*
         * Repository Providers.
         */
        App\Model\Providers\Data\ArticleArticleCategoryRepositoryProvider::class, 
        App\Model\Providers\Data\ArticleCategoryRepositoryProvider::class, 
        App\Model\Providers\Data\ArticleRepositoryProvider::class, 
        App\Model\Providers\Data\ArticleCommentRepositoryProvider::class, 
        App\Model\Providers\Data\ArticleCommentVoteRepositoryProvider::class,         
        App\Model\Providers\Data\BadgeRepositoryProvider::class, 
        App\Model\Providers\Data\BalanceLogRepositoryProvider::class,
        App\Model\Providers\Data\BlockedUserRepositoryProvider::class,
        App\Model\Providers\Data\CompetitionBadgeRepositoryProvider::class, 
        App\Model\Providers\Data\CompetitionParticipantRepositoryProvider::class, 
        App\Model\Providers\Data\CompetitionPrizeRepositoryProvider::class,
        App\Model\Providers\Data\CompetitionRepositoryProvider::class, 
        App\Model\Providers\Data\ConversationMessageRepositoryProvider::class,
        App\Model\Providers\Data\ConversationRepositoryProvider::class,
        App\Model\Providers\Data\CurrencyRepositoryProvider::class,   
        App\Model\Providers\Data\FollowRepositoryProvider::class, 
        App\Model\Providers\Data\HistoricalPortfolioValueRepositoryProvider::class, 
        App\Model\Providers\Data\InvitedUserRepositoryProvider::class,
        App\Model\Providers\Data\NewsletterMessageRepositoryProvider::class,
        App\Model\Providers\Data\PasswordRecoveryConfirmationRepositoryProvider::class, 
        App\Model\Providers\Data\SignUpConfirmationRepositoryProvider::class,
        App\Model\Providers\Data\TradeCommentRepositoryProvider::class, 
        App\Model\Providers\Data\TradeCommentVoteRepositoryProvider::class, 
        App\Model\Providers\Data\TradeConditionRepositoryProvider::class, 
        App\Model\Providers\Data\TradeFeeRepositoryProvider::class,
        App\Model\Providers\Data\TradePairRepositoryProvider::class, 
        App\Model\Providers\Data\TradeRepositoryProvider::class, 
        App\Model\Providers\Data\TradeVoteRepositoryProvider::class, 
        App\Model\Providers\Data\UserBalanceRepositoryProvider::class,   
        App\Model\Providers\Data\UserNotificationRepositoryProvider::class, 
        App\Model\Providers\Data\UserNotificationSettingRepositoryProvider::class,    
        App\Model\Providers\Data\UserRepositoryProvider::class,   
        App\Model\Providers\Data\UserSocialMediaAccountRepositoryProvider::class,   
        App\Model\Providers\Data\PortfolioRepositoryProvider::class,   
        App\Model\Providers\Data\EarnPlayDollarRepositoryProvider::class,   
        App\Model\Providers\Data\RewardRepositoryProvider::class,   
        App\Model\Providers\Data\UserEarnPlayDollarRepositoryProvider::class,   
        App\Model\Providers\Data\UserRewardsRepositoryProvider::class,   
        App\Model\Providers\Data\SponsorRepositoryProvider::class,   
        App\Model\Providers\Data\DeviceRepositoryProvider::class,   
        App\Model\Providers\Data\ExchangeRepositoryProvider::class,   

        /*
         * Formatters Providers.
         */ 
        App\Model\Providers\Formatters\AdminSubsystem\ArticleFormatterProvider::class,
        App\Model\Providers\Formatters\AdminSubsystem\ArticleCategoryFormatterProvider::class,
        App\Model\Providers\Formatters\AdminSubsystem\UserFormatterProvider::class,
        App\Model\Providers\Formatters\AdminSubsystem\CurrencyFormatterProvider::class,
        App\Model\Providers\Formatters\AdminSubsystem\TradePairFormatterProvider::class,
        App\Model\Providers\Formatters\AdminSubsystem\CompetitionFormatterProvider::class,
        App\Model\Providers\Formatters\AdminSubsystem\BadgeFormatterProvider::class,
        App\Model\Providers\Formatters\AdminSubsystem\EmailFormatterProvider::class,
        App\Model\Providers\Formatters\AdminSubsystem\TradeFormatterProvider::class,
        App\Model\Providers\Formatters\AdminSubsystem\InvitedUserFormatterProvider::class,
        App\Model\Providers\Formatters\AdminSubsystem\CompetitionPrizeFormatterProvider::class,
        App\Model\Providers\Formatters\AdminSubsystem\EarnPlayDollarFormatterProvider::class,
        App\Model\Providers\Formatters\AdminSubsystem\RewardFormatterProvider::class,
        App\Model\Providers\Formatters\AdminSubsystem\SponsorFormatterProvider::class,
        App\Model\Providers\Formatters\AdminSubsystem\ExchangeFormatterProvider::class,
        App\Model\Providers\Formatters\Common\HistoricalFormatterProvider::class, 
        App\Model\Providers\Formatters\Common\NotificationFormatterProvider::class, 
        App\Model\Providers\Formatters\Common\ConversationFormatterProvider::class, 
        App\Model\Providers\Formatters\Common\ConversationMessageFormatterProvider::class, 
        App\Model\Providers\Formatters\Common\CompetitionPrizeFormatterProvider::class, 
        App\Model\Providers\Formatters\Common\PortfolioFormatterProvider::class, 
        App\Model\Providers\Formatters\FrontSubsystem\EmailFormatterProvider::class,
        App\Model\Providers\Formatters\FrontSubsystem\UserFormatterProvider::class,
        App\Model\Providers\Formatters\TradeSubsystem\ArticleCommentFormatterProvider::class,
        App\Model\Providers\Formatters\TradeSubsystem\BalanceFormatterProvider::class,
        App\Model\Providers\Formatters\TradeSubsystem\CurrencyFormatterProvider::class,
        App\Model\Providers\Formatters\TradeSubsystem\FollowFormatterProvider::class,
        App\Model\Providers\Formatters\TradeSubsystem\TradeCommentFormatterProvider::class,
        App\Model\Providers\Formatters\TradeSubsystem\TradeFormatterProvider::class,
        App\Model\Providers\Formatters\TradeSubsystem\UserFormatterProvider::class,
        App\Model\Providers\Formatters\TradeSubsystem\UserNotificationSettingFormatterProvider::class,
        App\Model\Providers\Formatters\TradeSubsystem\CompetitionFormatterProvider::class,
        App\Model\Providers\Formatters\TradeSubsystem\ArticleFormatterProvider::class,
        App\Model\Providers\Formatters\TradeSubsystem\TradeConditionFormatterProvider::class,
        App\Model\Providers\Formatters\TradeSubsystem\TradeFeeFormatterProvider::class,
        App\Model\Providers\Formatters\TradeSubsystem\TradePairFormatterProvider::class,
        App\Model\Providers\Formatters\TradeSubsystem\CryptoCurrencyFormatterProvider::class,
        App\Model\Providers\Formatters\TradeSubsystem\InvitedUserFormatterProvider::class,
        App\Model\Providers\Formatters\TradeSubsystem\BlockedUserFormatterProvider::class,
        App\Model\Providers\Formatters\TradeSubsystem\RewardFormatterProvider::class,
        App\Model\Providers\Formatters\TradeSubsystem\EarnPlayDollarFormatterProvider::class,
        App\Model\Providers\Formatters\TradeSubsystem\ExchangeFormatterProvider::class,
        App\Model\Providers\Formatters\TradeSubsystem\PortfolioFormatterProvider::class,
        
        /*
         * Validators Providers.
         */ 
        App\Model\Providers\Validators\Common\UserValidatorProvider::class,     
        App\Model\Providers\Validators\Common\EmailValidatorProvider::class, 
        App\Model\Providers\Validators\Common\TradeValidatorProvider::class,
        App\Model\Providers\Validators\Common\CommentValidatorProvider::class,  
        App\Model\Providers\Validators\Common\ConversationMessageValidatorProvider::class,  
        App\Model\Providers\Validators\Common\TradeConditionValidatorProvider::class,  
        App\Model\Providers\Validators\Common\PortfolioValidatorProvider::class,  
        App\Model\Providers\Validators\Common\RewardValidatorProvider::class,  
        App\Model\Providers\Validators\Common\ExchangeValidatorProvider::class,  
        App\Model\Providers\Validators\AdminSubsystem\ArticleValidatorProvider::class, 
        App\Model\Providers\Validators\AdminSubsystem\UserValidatorProvider::class, 
        App\Model\Providers\Validators\AdminSubsystem\CurrencyValidatorProvider::class, 
        App\Model\Providers\Validators\AdminSubsystem\TradePairValidatorProvider::class,   
        App\Model\Providers\Validators\AdminSubsystem\CompetitionValidatorProvider::class, 
        App\Model\Providers\Validators\AdminSubsystem\BadgeValidatorProvider::class, 
        App\Model\Providers\Validators\AdminSubsystem\EmailValidatorProvider::class, 
        App\Model\Providers\Validators\AdminSubsystem\TradeValidatorProvider::class, 
        App\Model\Providers\Validators\AdminSubsystem\CompetitionPrizeValidatorProvider::class, 
        App\Model\Providers\Validators\AdminSubsystem\EarnPlayDollarValidatorProvider::class, 
        App\Model\Providers\Validators\AdminSubsystem\RewardValidatorProvider::class, 
        App\Model\Providers\Validators\AdminSubsystem\SponsorValidatorProvider::class, 
        
        /*
         * Service Providers.
         */
        App\Model\Providers\Services\Common\UserServiceProvider::class,        
        App\Model\Providers\Services\Common\TokenServiceProvider::class,       
        App\Model\Providers\Services\Common\EmailServiceProvider::class,        
        App\Model\Providers\Services\Common\FileServiceProvider::class,  
        App\Model\Providers\Services\Common\NotificationServiceProvider::class,
        App\Model\Providers\Services\Common\CommentServiceProvider::class,         
        App\Model\Providers\Services\Common\CurlServiceProvider::class,       
        App\Model\Providers\Services\Common\HistoricalServiceProvider::class,
        App\Model\Providers\Services\Common\HtmlParserServiceProvider::class,
        App\Model\Providers\Services\Common\MentionServiceProvider::class, 
        App\Model\Providers\Services\Common\ConversationServiceProvider::class, 
        App\Model\Providers\Services\Common\ConversationMessageServiceProvider::class, 
        App\Model\Providers\Services\Common\PortfolioServiceProvider::class,
        App\Model\Providers\Services\Common\BroadcastServiceProvider::class,
        App\Model\Providers\Services\FrontSubsystem\UserServiceProvider::class,
        App\Model\Providers\Services\FrontSubsystem\DeviceServiceProvider::class,
        App\Model\Providers\Services\TradeSubsystem\ArticleCommentServiceProvider::class,
        App\Model\Providers\Services\TradeSubsystem\UserServiceProvider::class,
        App\Model\Providers\Services\TradeSubsystem\CurrencyServiceProvider::class,
        App\Model\Providers\Services\TradeSubsystem\TradeServiceProvider::class,  
        App\Model\Providers\Services\TradeSubsystem\BalanceServiceProvider::class,
        App\Model\Providers\Services\TradeSubsystem\FeedServiceProvider::class,
        App\Model\Providers\Services\TradeSubsystem\TradeCommentServiceProvider::class,
        App\Model\Providers\Services\TradeSubsystem\FollowServiceProvider::class,
        App\Model\Providers\Services\TradeSubsystem\CompetitionServiceProvider::class,
        App\Model\Providers\Services\TradeSubsystem\BadgeServiceProvider::class,
        App\Model\Providers\Services\TradeSubsystem\ArticleServiceProvider::class,
        App\Model\Providers\Services\TradeSubsystem\TradeConditionServiceProvider::class,
        App\Model\Providers\Services\TradeSubsystem\TradeFeeServiceProvider::class,
        App\Model\Providers\Services\TradeSubsystem\TradePairServiceProvider::class,
        App\Model\Providers\Services\TradeSubsystem\CryptoCurrencyServiceProvider::class,
        App\Model\Providers\Services\TradeSubsystem\InvitedUserServiceProvider::class,
        App\Model\Providers\Services\TradeSubsystem\BlockedUserServiceProvider::class,
        App\Model\Providers\Services\TradeSubsystem\EarnPlayDollarServiceProvider::class,
        App\Model\Providers\Services\TradeSubsystem\RewardServiceProvider::class,
        App\Model\Providers\Services\TradeSubsystem\ExchangeServiceProvider::class,
        App\Model\Providers\Services\TradeSubsystem\PortfolioServiceProvider::class,
        App\Model\Providers\Services\AdminSubsystem\ArticleServiceProvider::class,
        App\Model\Providers\Services\AdminSubsystem\ArticleCategoryServiceProvider::class,
        App\Model\Providers\Services\AdminSubsystem\UserServiceProvider::class,
        App\Model\Providers\Services\AdminSubsystem\CurrencyServiceProvider::class,
        App\Model\Providers\Services\AdminSubsystem\TradePairServiceProvider::class,
        App\Model\Providers\Services\AdminSubsystem\CompetitionServiceProvider::class,
        App\Model\Providers\Services\AdminSubsystem\BadgeServiceProvider::class,
        App\Model\Providers\Services\AdminSubsystem\EmailServiceProvider::class,
        App\Model\Providers\Services\AdminSubsystem\TradeServiceProvider::class,
        App\Model\Providers\Services\AdminSubsystem\NewsletterMessageServiceProvider::class,
        App\Model\Providers\Services\AdminSubsystem\InvitedUserServiceProvider::class,
        App\Model\Providers\Services\AdminSubsystem\CompetitionPrizeServiceProvider::class,
        App\Model\Providers\Services\AdminSubsystem\UserNotificationServiceProvider::class,
        App\Model\Providers\Services\AdminSubsystem\PortfolioServiceProvider::class,
        App\Model\Providers\Services\AdminSubsystem\UserBalanceServiceProvider::class,
        App\Model\Providers\Services\AdminSubsystem\EarnPlayDollarServiceProvider::class,
        App\Model\Providers\Services\AdminSubsystem\SponsorServiceProvider::class,
        App\Model\Providers\Services\AdminSubsystem\RewardServiceProvider::class,
        App\Model\Providers\Services\AdminSubsystem\ExchangeServiceProvider::class,
        App\Model\Providers\Services\AdminSubsystem\QueueServiceProvider::class,
    
        /*
         * Package Service Providers...
         */

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        Felixkiss\UniqueWithValidator\ServiceProvider::class,
        'Spatie\PaginateRoute\PaginateRouteServiceProvider',
        Laravolt\Avatar\ServiceProvider::class,
        Merujan99\LaravelVideoEmbed\Providers\LaravelVideoEmbedServiceProvider::class,
        'Buzz\LaravelGoogleCaptcha\CaptchaServiceProvider',
        Morrislaptop\LaravelQueueClear\LaravelQueueClearServiceProvider::class

    ],

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => [

        'App' => Illuminate\Support\Facades\App::class,
        'Artisan' => Illuminate\Support\Facades\Artisan::class,
        'Auth' => Illuminate\Support\Facades\Auth::class,
        'Balance' => App\Model\Facades\Balance::class,
        'Blade' => Illuminate\Support\Facades\Blade::class,
        'Broadcast' => Illuminate\Support\Facades\Broadcast::class,
        'Bus' => Illuminate\Support\Facades\Bus::class,
        'Cache' => Illuminate\Support\Facades\Cache::class,
        'Config' => Illuminate\Support\Facades\Config::class,
        'Cookie' => Illuminate\Support\Facades\Cookie::class,
        'Crypt' => Illuminate\Support\Facades\Crypt::class,
        'DB' => Illuminate\Support\Facades\DB::class,
        'Eloquent' => Illuminate\Database\Eloquent\Model::class,
        'Event' => Illuminate\Support\Facades\Event::class,
        'File' => Illuminate\Support\Facades\File::class,
        'Gate' => Illuminate\Support\Facades\Gate::class,
        'Hash' => Illuminate\Support\Facades\Hash::class,
        'Lang' => Illuminate\Support\Facades\Lang::class,
        'Log' => Illuminate\Support\Facades\Log::class,
        'Mail' => Illuminate\Support\Facades\Mail::class,
        'Notification' => Illuminate\Support\Facades\Notification::class,
        'Number' => App\Model\Facades\Number::class,
        'Password' => Illuminate\Support\Facades\Password::class,
        'Queue' => Illuminate\Support\Facades\Queue::class,
        'Redirect' => Illuminate\Support\Facades\Redirect::class,
        'Redis' => Illuminate\Support\Facades\Redis::class,
        'Request' => Illuminate\Support\Facades\Request::class,
        'Response' => Illuminate\Support\Facades\Response::class,
        'Route' => Illuminate\Support\Facades\Route::class,
        'Schema' => Illuminate\Support\Facades\Schema::class,
        'Session' => Illuminate\Support\Facades\Session::class,
        'Storage' => Illuminate\Support\Facades\Storage::class,
        'URL' => Illuminate\Support\Facades\URL::class,
        'Validator' => Illuminate\Support\Facades\Validator::class,
        'View' => Illuminate\Support\Facades\View::class,
        'Image' => Intervention\Image\Facades\Image::class,
        'PaginateRoute' => 'Spatie\PaginateRoute\PaginateRouteFacade',
        'Pagination' => App\Model\Facades\Pagination::class,
        'Strings' => App\Model\Facades\Strings::class,
        'Media' => App\Model\Facades\Media::class,
        'Feed' => App\Model\Facades\Feed::class,
        'Currency' => App\Model\Facades\Currency::class,
        'Time' => App\Model\Facades\Time::class,
        'Avatar'    => Laravolt\Avatar\Facade::class,
        'LaravelVideoEmbed' => Merujan99\LaravelVideoEmbed\Facades\LaravelVideoEmbed::class,
        'GeoIP' => \Torann\GeoIP\Facades\GeoIP::class,
        'Fcm' => Kawankoding\Fcm\FcmFacade::class,
    ],

];
