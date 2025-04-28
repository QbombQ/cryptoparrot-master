let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/js/TradeSubsystem/verification-steps.js', 'public/assets/js/TradeSubsystem').version()
    .js('resources/assets/js/TradeSubsystem/trade.js', 'public/assets/js/TradeSubsystem').version()
    .js('resources/assets/js/TradeSubsystem/common.js', 'public/assets/js/TradeSubsystem').version()
    .js('resources/assets/js/TradeSubsystem/portfolio.js', 'public/assets/js/TradeSubsystem').version()
    .js('resources/assets/js/TradeSubsystem/feed.js', 'public/assets/js/TradeSubsystem').version()
    .js('resources/assets/js/echo.js', 'public/assets/js').version()
    .js('resources/assets/js/app.js', 'public/assets/js').version()
    .js('resources/assets/js/FrontSubsystem/article.js', 'public/assets/js/FrontSubsystem').version()
    .js('resources/assets/js/TradeSubsystem/rewards.js', 'public/assets/js/TradeSubsystem').version()
    .js('resources/assets/js/TradeSubsystem/my-trades.js', 'public/assets/js/TradeSubsystem').version()
    .js('resources/assets/js/TradeSubsystem/cryptocurrencies.js', 'public/assets/js/TradeSubsystem').version()
    .js('resources/assets/js/AdminSubsystem/trade.js', 'public/assets/js/AdminSubsystem').version()
    .js('resources/assets/js/AdminSubsystem/post.js', 'public/assets/js/AdminSubsystem').version()
    .js('resources/assets/js/AdminSubsystem/global.js', 'public/assets/js/AdminSubsystem').version()
    .sass('resources/assets/sass/app.scss', 'public/assets/css/app.css').version();
 