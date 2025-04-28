<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->call(UsersTableSeeder::class);
        $this->call(UserSocialMediaAccountsTableSeeder::class);
        $this->call(BadgesTableSeeder::class);
        $this->call(UserBadgesTableSeeder::class);
        $this->call(FollowsTableSeeder::class);
        $this->call(NotificationTypeTableSeeder::class);
        $this->call(UserNotificationsTableSeeder::class);
        $this->call(CurrenciesTableSeeder::class);
        //$this->call(PortfolioTableSeeder::class);
        $this->call(UserBalancesTableSeeder::class);
        // $this->call(TradesTableSeeder::class);
        $this->call(TradePairTableSeeder::class);
        // $this->call(TradeCommentTableSeeder::class);
        $this->call(ArticleTableSeeder::class);
        $this->call(ArticleCategoryTableSeeder::class);
        $this->call(ArticleArticleCategoryTableSeeder::class);
        $this->call(CompetitionTableSeeder::class);
        $this->call(CompetitionBadgeTableSeeder::class);
        $this->call(CompetitionParticipantTableSeeder::class);
        $this->call(HistoricalPortfolioValueTableSeeder::class);
        $this->call(UserNotificationSettingTableSeeder::class);
        $this->call(ConversationTableSeeder::class);
        $this->call(ConversationMessageTableSeeder::class);
        $this->call(SponsorTableSeeder::class);
        $this->call(RewardsTableSeeder::class);
        $this->call(EarnPlayDollarsTableSeeder::class);
        $this->call(UserEarnPlayDollarsTableSeeder::class);
        $this->call(UserRewardsTableSeeder::class);

    }
}
