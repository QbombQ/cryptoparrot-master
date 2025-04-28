<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Model\Data\Models\User::class, function (Faker $faker, $data) {
    return [
        'username' => isset($data['username']) ? $data['username'] : $faker->username,
        'email' => isset($data['email']) ? $data['email'] : $faker->unique()->safeEmail,
        'password' => Hash::make('password'),
        'method' => $data['method'],
        'status' => $data['status'],
        'avatar' => isset($data['avatar']) ? $data['avatar'] : null,
        'handle' => isset($data['handle']) ? $data['handle'] : null,
        'cover' => isset($data['cover']) ? $data['cover'] : null,
        'description' => isset($data['description']) ? $data['description'] : null,
        'type' => isset($data['type']) ? $data['type'] : 'trader',
        'key' => isset($data['key']) ? $data['key'] : str_random(10),
        'remember_token' => str_random(10)
    ];
});

$factory->define(App\Model\Data\Models\SignUpConfirmation::class, function (Faker $faker, $data) {
    return [
        'user_id' => $data['user_id'],
        'token' => isset($data['token']) ? $data['token'] : str_random(10),
    ];
});

$factory->define(App\Model\Data\Models\Portfolio::class, function (Faker $faker, $data) {
    return [
        'user_id' => $data['user_id'],
        'title' => isset($data['title']) ? $data['title'] : str_random(10),
        'portfolio_value_in_usd' => isset($data['portfolio_value_in_usd']) ? $portfolio_value_in_usd : 100000,
        'start_portfolio_value_in_usd' => isset($data['start_portfolio_value_in_usd']) ? $start_portfolio_value_in_usd : 100000
    ];
});

$factory->define(App\Model\Data\Models\StripeCredentials::class, function (Faker $faker, $data) {
    return [
        'user_id' => $data['user_id'],
        'stripe_customer_id' => isset($data['stripe_customer_id']) ? $data['stripe_customer_id'] : null,
        'stripe_account_id' => isset($data['stripe_account_id']) ? $data['stripe_account_id'] : null,
        'stripe_product_id' => isset($data['stripe_product_id']) ? $data['stripe_product_id'] : null
    ];
});

$factory->define(App\Model\Data\Models\StripePlan::class, function (Faker $faker, $data) {
    return [
        'user_id' => $data['user_id'],
        'stripe_plan_id' => isset($data['stripe_plan_id']) ? $data['stripe_plan_id'] : str_random(10),
        'amount' => isset($data['amount']) ? $data['amount'] : 0
    ];
});

$factory->define(App\Model\Data\Models\StripeSource::class, function (Faker $faker, $data) {
    return [
        'user_id' => $data['user_id'],
        'stripe_source_id' => isset($data['stripe_source_id']) ? $data['stripe_source_id'] : str_random(10)
    ];
});

$factory->define(App\Model\Data\Models\StripeSubscription::class, function (Faker $faker, $data) {
    return [
        'user_id' => $data['user_id'],
        'patron_id' => $data['patron_id'],
        'plan_id' => $data['plan_id'],
        'stripe_subscription_id' => isset($data['stripe_subscription_id']) ? $data['stripe_subscription_id'] : null,
        'stripe_shared_customer_id' => isset($data['stripe_shared_customer_id']) ? $data['stripe_shared_customer_id'] : null,
        'status' => isset($data['status']) ? $data['status'] : 'active',
        'period_end' => isset($data['period_end']) ? $data['period_end'] : '2018-01-01'
    ];
});

$factory->define(App\Model\Data\Models\PasswordRecoveryConfirmation::class, function (Faker $faker, $data) {
    return [
        'user_id' => $data['user_id'],
        'token' => isset($data['token']) ? $data['token'] : str_random(10),
    ];
});

$factory->define(App\Model\Data\Models\UserSocialMediaAccount::class, function (Faker $faker, $data) {
    return [
        'user_id' => $data['user_id'],
        'url' => isset($data['url']) ? $data['url'] : str_random(10),
        'social_network' => $data['social_network']
    ];
});

$factory->define(App\Model\Data\Models\UserNotification::class, function (Faker $faker, $data) {
    return [
        'user_id' => $data['user_id'],
        'text' => isset($data['text']) ? $data['text'] : str_random(10),
        'url' => isset($data['url']) ? $data['url'] : str_random(10),
        'status' => isset($data['status']) ? $data['status'] : 'unread',
        'type_id' => $data['type_id']
    ];
});

$factory->define(App\Model\Data\Models\NotificationType::class, function (Faker $faker, $data) {
    return [
        'icon' => isset($data['icon']) ? $data['icon'] : str_random(10),
        'title' => isset($data['title']) ? $data['title'] : str_random(10)
    ];
});

$factory->define(App\Model\Data\Models\Badge::class, function (Faker $faker, $data) {
    return [
        'title' => $data['title']
    ];
});

$factory->define(App\Model\Data\Models\UserBadge::class, function (Faker $faker, $data) {
    return [
        'user_id' => $data['user_id'],
        'badge_id' => $data['badge_id']
    ];
});

$factory->define(App\Model\Data\Models\Follow::class, function (Faker $faker, $data) {
    return [
        'follower_id' => $data['follower_id'],
        'following_id' => $data['following_id']
    ];
});

$factory->define(App\Model\Data\Models\Patron::class, function (Faker $faker, $data) {
    return [
        'user_id' => $data['user_id'],
        'patron_id' => $data['patron_id']
    ];
});

$factory->define(App\Model\Data\Models\Currency::class, function (Faker $faker, $data) {
    return [
        'name' => $data['name'],
        'acronym' => $data['acronym'],
        'symbol' => $data['symbol'],
        'usd_value' => $data['usd_value'],
        'average_usd_value' => isset($data['average_usd_value']) ? $data['average_usd_value'] : null,
        'crypto' => isset($data['crypto']) ? $data['crypto'] : false
    ];
});

$factory->define(App\Model\Data\Models\TradePair::class, function (Faker $faker, $data) {
    return [
        'to_currency_id' => $data['to_currency_id'],
        'from_currency_id' => $data['from_currency_id'],
        'rate' => $data['rate'],
        'rate_sell' => $data['rate_sell'],
        'buy_volume_limit' => isset($data['buy_volume_limit']) ? $data['buy_volume_limit'] : 500000,
        'sell_volume_limit' => isset($data['sell_volume_limit']) ? $data['sell_volume_limit'] : 500000
    ];
});

$factory->define(App\Model\Data\Models\TradeVote::class, function (Faker $faker, $data) {
    return [
        'user_id' => $data['user_id'],
        'trade_id' => $data['trade_id']
    ];
});

$factory->define(App\Model\Data\Models\UserBalance::class, function (Faker $faker, $data) {
    return [
        'user_id' => $data['user_id'],
        'currency_id' => $data['currency_id'],
        'amount' => $data['amount'],
        'reserved_amount' => $data['reserved_amount'],
        'usd_value' => $data['usd_value'],
        'portfolio_id' => $data['portfolio_id']
    ];
});

$factory->define(App\Model\Data\Models\Trade::class, function (Faker $faker, $data) {
    return [
        'type' => $data['type'],
        'amount' => $data['amount'],
        'target_price' => $data['target_price'],
        'start_price' => $data['target_price'],
        'description' => isset($data['description']) ? $data['description'] : null,
        'leverage' => isset($data['leverage']) ? $data['leverage'] : 0,
        'public' => isset($data['public']) ? $data['public'] : 1,
        'source_type' => isset($data['source_type']) ? $data['source_type'] : null,
        'source' => isset($data['source']) ? $data['source'] : null,
        'user_id' => $data['user_id'],
        'status' => $data['status'],
        'votes' => isset($data['votes']) ? $data['votes'] : 0,
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
        'portfolio_id' => $data['portfolio_id']
    ];
});

$factory->define(App\Model\Data\Models\TradeComment::class, function (Faker $faker, $data) {
    return [
        'comment' => isset($data['comment']) ? $data['comment'] : str_random(10),
        'user_id' => $data['user_id'],
        'trade_id' => $data['trade_id'],
        'reply_to' => isset($data['reply_to']) ? $data['reply_to'] : null,
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now()
    ];
});

$factory->define(App\Model\Data\Models\TradeCommentVote::class, function (Faker $faker, $data) {
    return [
        'user_id' => $data['user_id'],
        'comment_id' => $data['comment_id']
    ];
});

$factory->define(App\Model\Data\Models\Competition::class, function (Faker $faker, $data) {
    return [
        'title' => $data['title'],
        'start_date' => $data['start_date'],
        'end_date' => $data['end_date'],
        'status' => $data['status'],
        'description' => null,
        'prize' => null,
        'logo' => null
    ];
});

$factory->define(App\Model\Data\Models\CompetitionParticipant::class, function (Faker $faker, $data) {
    return [
        'user_id' => $data['user_id'],
        'competition_id' => $data['competition_id'],
        'portfolio_start_value' => isset($data['portfolio_start_value']) ? $data['portfolio_start_value'] : null,
        'portfolio_end_value' => isset($data['portfolio_end_value']) ? $data['portfolio_end_value'] : null,
        'start_trades' => null,
        'current_trades' => null,
        'end_trades' => null,
        'current_portfolio_value' => null,
        'change' => 0
    ];
});
