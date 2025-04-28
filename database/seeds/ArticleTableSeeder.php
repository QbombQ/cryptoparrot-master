<?php

use Illuminate\Database\Seeder;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $articles = [
            [
                'title' => 'Let\'s take a look at some emerging blockchain tech projects & what they could mean for the price of the crypto you hold or trade',
                'excerpt' => 'Keeping an eye on the use case behind the technology could lift your portfolio to all new levels',
                'content' => '',
                'thumbnail' => 'images/article_thumbnails/1/forbes.jpg',
                'slug' => null, 
                'url' => 'https://www.forbes.com/sites/forbescoachescouncil/2018/09/10/the-most-promising-emerging-blockchain-technologies-and-what-they-mean-for-crypto-prices/#5696d8cc7090', 
                'user_id' => null,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'title' => 'Twitter is now recommending users follow cryptocurrency scambots',
                'excerpt' => 'Woooooo wait a second...we\'re you taking us Twitter and what do these bots want with us?',
                'content' => '',
                'thumbnail' => 'images/article_thumbnails/2/twitter.jpg',
                'slug' => null,
                'url' => 'https://thenextweb.com/hardfork/2018/08/14/twitter-recommend-spambots-elon-musk/',
                'user_id' => null,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'title' => 'Half of millennials say cryptocurrency will soon be widely used',
                'excerpt' => 'The other half are a lost cause doomed',
                'content' => '',
                'thumbnail' => 'images/article_thumbnails/3/millennials.jpg',
                'slug' => null,
                'url' => 'https://www.finder.com.au/half-of-millennials-say-cryptocurrency-will-soon-be-widely-used',
                'user_id' => null,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'title' => '5 Women Leading in the Cryptocurrency Industry',
                'excerpt' => 'Here are 5 amazing women leading the charge to ensure the crypto-sphere is not just an old boys club ',
                'content' => '',
                'thumbnail' => 'images/article_thumbnails/4/women.jpg',
                'slug' => null,
                'url' => 'https://news.ibinex.com/2018/09/10/5-women-leading-in-the-cryptocurrency-industry/',
                'user_id' => null,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'title' => 'Bitcoin is Famous: Top 7 Celebrities with Strong Cryptocurrency Ties',
                'excerpt' => 'Should we care?  Do we care? Do you care? ',
                'content' => '',
                'thumbnail' => 'images/article_thumbnails/5/bitcoin.jpg',
                'slug' => null,
                'url' => 'https://bitcoinexchangeguide.com/bitcoin-is-famous-top-7-celebrities-with-strong-cryptocurrency-ties/',
                'user_id' => null,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'title' => 'Dealing in cryptocurrency is catching on among Silicon Valley jewelers',
                'excerpt' => 'You know mass adoption is headed in the right direction when Silicon Valley Jewelers start getting involved',
                'content' => '',
                'thumbnail' => 'images/article_thumbnails/6/jewelers.jpg',
                'slug' => null,
                'url' => 'https://www.glossy.co/fashion/dealing-in-cryptocurrency-is-catching-on-among-silicon-valley-jewelers',
                'user_id' => null,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'title' => 'When it comes to Art, is Blockchain: Hot stuff or hot air?',
                'excerpt' => 'Blockchain offers the promise of a world in which a work of art’s origin or source is held on a single database—if it lives up to the hype',
                'content' => '',
                'thumbnail' => 'images/article_thumbnails/7/hot.jpg',
                'slug' => null,
                'url' => 'https://www.theartnewspaper.com/feature/blockchain-hot-stuff-or-hot-air',
                'user_id' => null,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'title' => 'Could blockchain have prevented the fake honey scandal?',
                'excerpt' => 'Honey is being adulterated and blockchain just might me the solution to stopping the fraud',
                'content' => '',
                'thumbnail' => 'images/article_thumbnails/8/honey.jpg',
                'slug' => null,
                'url' => 'https://www.afr.com/technology/how-new-technologies-like-blockchain-could-have-prevented-the-fake-honey-scandal-20180906-h15146',
                'user_id' => null,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now() 
            ], 
            [
                'title' => 'Could blockchain have prevented the fake honey scandal?',
                'excerpt' => 'Honey is being adulterated and blockchain just might me the solution to stopping the fraud',
                'content' => '',
                'thumbnail' => 'images/article_thumbnails/8/jewelers.jpg',
                'slug' => null,
                'url' => 'https://www.afr.com/technology/how-new-technologies-like-blockchain-could-have-prevented-the-fake-honey-scandal-20180906-h15146',
                'user_id' => null,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now() 
            ]                                                                                                          
        ];

        /*
        $articles = [
            [
                'title' => 'RBC Report: Crypto and Blockchain Could Unlock $10 Trillion Market',
                'excerpt' => 'A research analyst at the Royal Bank of Canada (RBC) sees cryptocurrency, blockchain technology and decentralization as a potential $10 trillion ecosystem.',
                'content' => '<p>A research analyst at the Royal Bank of Canada (RBC) sees cryptocurrency, blockchain technology and decentralization as a potential $10 trillion ecosystem.</p><p>In a new report released Wednesday, Mitch Steves, an equities&nbsp;<a data-cke-saved-href="https://www.coindesk.com/cryptocurrency-price-surge-could-boost-gpu-sales-says-wall-street-analyst/" href="https://www.coindesk.com/cryptocurrency-price-surge-could-boost-gpu-sales-says-wal-street-analyst/">analyst</a>&nbsp;with RBC\'s Capital Markets subsidiary, laid out his bull case for why the future of transactional services will ultimately be decentralized. "While the cryptocurrency space has many risks, the opportunity appears vast with constant technology updates," he wrote.</p><p>Though startups that enable cryptocurrency protocols to serve as decentralized alternatives to proprietary services or as a means of transmitting remittances have garnered the most interest throughout the ecosystem\'s formative years, Steves argues that the protocol layer (on which these services will be built) is where most of the value will be realized.</p><p>"We see that the protocol layer will capture more value than the applications," he wrote, adding:</p><blockquote><p>"As the application becomes successful, the protocol layer captures more value, which then creates more interest in additional decentralized application development."</p></blockquote><p>As such, the comments echo the&nbsp;<a data-cke-saved-href="http://www.usv.com/blog/fat-protocols" href="http://www.usv.com/blog/fat-protocols" rel="external noopener noreferrer" target="_blank">fat protocol theory</a>&nbsp;put forward by Union Square Ventures, which states value creation on decentralized cryptocurrencies will occur at the lower infrastructure layers.</p><p>The report also asserts that the&nbsp;<a data-cke-saved-href="https://www.coindesk.com/inevitable-bust-gpu-makers-see-crypto-mining-short-term-sales-boost/" href="https://www.coindesk.com/inevitable-bust-gpu-makers-see-crypto-mining-short-term-sales-boost/" rel="noopener" target="_blank">market&nbsp;</a>for cryptocurrency&nbsp;<a data-cke-saved-href="https://www.coindesk.com/like-not-public-companies-feeling-crypto-mining-boom/" href="https://www.coindesk.com/like-not-public-companies-feeling-crypto-mining-boom/" rel="noopener" target="_blank">mining</a>&nbsp;is here to stay, arguing that there currently exists an at least $4.2 billion market for bitcoin&nbsp;<a data-cke-saved-href="https://www.coindesk.com/amd-sees-long-term-leveling-off-cryptocurrency-mining-demand/" href="https://www.coindesk.com/amd-sees-long-term-leveling-off-cryptocurrency-mining-demand/" rel="noopener" target="_blank">mining</a>&nbsp;equipment with an additional $350-$450 million for other ASIC-mined cryptocurrencies like bitcoin cash and another $1.9 billion market for&nbsp;<a data-cke-saved-href="https://www.coindesk.com/cryptocurrency-mining-chip-sales-cool-q3-says-nvidia/" href="https://www.coindesk.com/cryptocurrency-mining-chip-sales-cool-q3-says-nvidia/" rel="noopener" target="_blank">GPU</a>-mined coins like ethereum and&nbsp;<a data-cke-saved-href="https://www.coindesk.com/monero-mining-malware-hits-russian-pipeline-giant-transneft/" href="https://www.coindesk.com/monero-mining-malware-hits-russian-pipeline-giant-transneft/" rel="noopener" target="_blank">monero</a>.</p><p>Notably, the report argues that decentralized technology in its current state is misunderstood and underrated, claiming that cryptocurrencies are becoming better able to handle an increasing number of transactions. In particular, Steves sees the&nbsp;<a data-cke-saved-href="https://www.coindesk.com/lightning-bitcoin-scaling-tech-really-know/" href="https://www.coindesk.com/lightning-bitcoin-scaling-tech-really-know/" rel="noopener" target="_blank">Lightning Network</a>&nbsp;as a tool to enable more than a million transactions per second on bitcoin.</p><p>Still, scalability, along with government intervention and the creation of more sophisticated wallet hacking techniques, was identified as one of the key risks facing the ecosystem.</p><p>Continued progress on these fronts, however, will be a boon for the development and mainstream adoption of a global&nbsp;<a data-cke-saved-href="https://www.coindesk.com/world-computer-new-protocol-supercharge-ethereums-blockchain/" href="https://www.coindesk.com/world-computer-new-protocol-supercharge-ethereums-blockchain/" rel="noopener" target="_blank">supercomputer</a>, whether it be ethereum-based or on an alternative, provided that blockchain\'s impeccable security record remains spotless, Steves said.</p><p>"As scaling and protocols mature, the value of a decentralized world computer could potentially become a multi-trillion dollar industry," Steves wrote, concluding: "If there\'s one positive technology item we can agree on, it\'s that the blockchain has never been hacked. What happens if we build on top of this secure layer?"</p><p><em><a data-cke-saved-href="https://www.shutterstock.com/image-photo/toronto-canada-december-212016-headquarters-rbc-542361301?src=mqd6CV50PVTm0Ak1ipmrAA-1-2" href="https://www.shutterstock.com/image-photo/toronto-canada-december-212016-headquarters-rbc-542361301?src=mqd6CV50PVTm0Ak1ipmrAA-1-2" rel="noopener external noreferrer" target="_blank">Royal Bank of Canada</a>&nbsp;image via&nbsp;BalkansCat / Shutterstock</em></p>',
                'thumbnail' => 'images/article_thumbnails/1/rbc.jpg',
                'slug' => 'rbc-report-crypto-and-blockchain-could-unlock-10-trillion-market',
                'url' => null,
                'user_id' => 2,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'title' => 'The 6 Major Blockchain Trends For 2018 Outlined By Deloitte',
                'excerpt' => 'While the mainstream viability of cryptocurrency remains in question, one of the technologies that has emerged in its wake is primed to do big things.',
                'content' => '<p>While the mainstream viability of cryptocurrency remains in question, one of the technologies that has emerged in its wake is primed to do big things. Blockchain continues to grow in popularity as people across multiple industries find new applications for it. Recently, Deloitte released a report entitled, ‘2018 Global Blockchain Survey’. In it, they explore several relevant, blockchain trends that are worth paying attention to in 2018 and onward. If you are interested in exploring what blockchain can do for your business or whether your startup idea can benefit from this versatile and secure technology, the prospects are rather promising. 1. Enterprises are now applying blockchain, not just exploring it According to Deloitte, a key shift is happening. Where businesses were once exploring blockchain’s potential to streamline business processes, even to disrupt them, today they are beginning to create actual applications for its use. While it’s still more common for tech or ‘digital’ enterprises to embrace this technology, this change definitely indicates that blockchain is gaining wider acceptance. More importantly, it’s gaining more confidence.</p>',
                'thumbnail' => 'images/article_thumbnails/2/re.jpg',
                'slug' => 'the-6-major-blockchain-trends-for-2018-outlined-by-deloitte',
                'url' => null,
                'user_id' => 2,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'title' => 'Bank of Montreal, Teachers’ Pension Fund Trial Canadian Dollar Debt Deal via Blockchain',
                'excerpt' => 'In the pilot transaction, the bank is said to have sold $250 million Canadian dollars (around $190 million) of one-year.',
                'content' => '<p>The Bank of Montreal and Ontario Teachers’ Pension Plan have tested a Canadian-dollar debt deal using blockchain, Bloomberg reports August 15. In the pilot transaction, the bank is said to have sold $250 million Canadian dollars (around $190 million) of one-year floating rate deposit notes to the teachers’ pension fund, implementing blockchain tech to mirror the transaction. This is reportedly the first use of the technology for a Canadian dollar “fixed-income issue.” Bloomberg notes that the Bank of Montreal’s BMO Capital Markets unit has built a prototype blockchain-based settlement system, which enables issuers and buyers to track transactions using the technology. The bank reportedly aims to harness the technology to secure major cost savings across compliance, financial reporting, and clearing and settlement of fiat transactions. Kelsey Gunderson, head of global trading at BMO Capital Markets stated: "This is an important first step in developing a fully functional blockchain capability that we think will eventually allow primary and secondary trading of securities." This year has seen another bullish national first for a similar initiative on blockchain, this time for the U.S. dollar. In April, JPMorgan Chase, the National Bank of Canada and others used the Quorum blockchain platform to mirror the Canadian bank’s $150 million offering “on the same day of a one-year floating-rate Yankee certificate of deposit.”</p>',
                'thumbnail' => 'images/article_thumbnails/3/1480_aHR0cHM6Ly9zMy5jb2ludGVsZWdyYXBoLmNvbS9zdG9yYWdlL3VwbG9hZHMvdmlldy9mMzdjMzVkNmI1YmU3Mzg5OTIxOGEwNGUwNGM5YmZiMS5qcGc=.jpg',
                'slug' => 'bank-of-montreal-teachers-pension-fund-trial-canadian-dollar-debt-deal-via-blockchain',
                'url' => null,
                'user_id' => 2,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'title' => 'Study: Few Ontarians Hold Crypto, Shaky Understanding of Fundamentals, Regulations',
                'excerpt' => 'Five percent of Ontarians own some form of “cryptoasset” according to a June 28 study from Canadian provincial financial regulator the Ontario Securities Commission.',
                'content' => '<p>Five percent of Ontarians own some form of “cryptoasset” according to a June 28 study from Canadian provincial financial regulator the Ontario Securities Commission. The study also found that while awareness of cryptocurrencies and digital assets is growing, overall knowledge of crypto is lacking. The report entitled “Taking Caution: Financial Consumers and the Cryptoasset Sector,” was conducted March 14-22, 2018, and involved 2,667 Ontarians. Many respondents showed a lack of understanding of fundamental concepts of crypto. When asked to identify six statements about the major cryptocurrency Bitcoin (BTC) as true or false, 34 percent of respondents provided correct answers for four statements, while only three percent successfully answered all of them. Crypto holders scored better, with 72 percent correctly identifying four of the six statements, and 15 percent answering all statements accurately. Among Onatrian crypto holders, 31 percent of respondents thought that Bitcoin is secure from cyberattacks, 16 percent thought that Bitcoin is backed by the government, while 34 percent answered “false” to the statement that “Bitcoin transactions are recorded on a distributed ledger that is publicly accessible.” The study also found that residents of the province are increasingly solicited to participate in initial coin offerings (ICOs). Per the study, 1.5 percent of Ontarians, or 170,000 people, have participated in an ICO. The report notes that ICO participation by residents is “of concern” because “many Ontarians are confused about whether token generation events, [ICOs], and initial token offerings… are subject to regulation.” The report concludes that residents of Ontario generally “[approach] cryptoassets with caution. A relatively small percentage of Ontarians owns cryptoassets, and those who do tend to spend relatively small amounts.” The study found that half of crypto holders spent under $1,000 on their assets. OSC director Tyler Fleming opined that “interest in this sector is not going to disappear any time soon” adding that “as people become more familiar with the product, we would certainly expect people to be doing more research, understanding the different types of products and risks out there.” Earlier this month, the Canadian government released a draft of new regulations on cryptocurrency exchanges and payment processors. The new regulations aim to correct a “number of deficiencies” outlined by the Financial Action Task Force in their 2015-16 evaluation, such as strengthening anti-money laundering and anti-terrorist financing regimes.</p>',
                'thumbnail' => 'images/article_thumbnails/4/1480_Ly9jb2ludGVsZWdyYXBoLmNvbS9zdG9yYWdlL3VwbG9hZHMvdmlldy85YzhmMmRmOGM3OGUxMDNhYmQwYTI3M2M0NDM3NDc2ZC5qcGc=.jpg',
                'slug' => 'study-few-ontarians-hold-crypto-shaky-understanding-of-fundamentals-regulations',
                'url' => null,
                'user_id' => 2,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'title' => 'This childhood game could be blockchain’s killer app',
                'excerpt' => 'This childhood game could be blockchain’s killer app',
                'content' => '<p>It’s the blockchain use case we didn’t know we wanted (and probably don’t need). We can now play the fabled playground game of our childhood, Rock, Paper, Scissors on blockchain.</p>',
                'thumbnail' => 'images/article_thumbnails/5/image.png',
                'slug' => 'this-childhood-game-could-be-blockchains-killer-app',
                'url' => null,
                'user_id' => 2,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'title' => '10 blockchain projects to keep an eye on',
                'excerpt' => 'We recently explored how blockchain is being used as a force for good and conducted a handful of interviews with practitioners in the industry.',
                'content' => '<p>We recently explored how blockchain is being used as a force for good and conducted a handful of interviews with practitioners in the industry.</p>',
                'thumbnail' => 'images/article_thumbnails/6/blockchain.jpg',
                'slug' => '10-blockchain-projects-to-keep-an-eye-on',
                'url' => null,
                'user_id' => 2,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'title' => 'Community Article',
                'excerpt' => 'We recently explored how blockchain is being used as a force for good and conducted a handful of interviews with practitioners in the industry.',
                'content' => '<p>We recently explored how blockchain is being used as a force for good and conducted a handful of interviews with practitioners in the industry.</p>',
                'thumbnail' => null,
                'slug' => '10-blockchain-projects-to-keep-an-eye-on-2',
                'url' => null,
                'user_id' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]                                                                                                       
        ];*/

        foreach($articles as $article) {
            DB::table('articles')->insert($article);
        }  
    }
}
