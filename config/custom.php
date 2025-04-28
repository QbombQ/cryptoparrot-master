<?php

if(env('APP_FORK') == 'fxparrot'){
 
return [
    'admin' => [
        'itemsPerPage' => 20
    ],
    'userRetention' => [
        'startDate' => env('USER_RETENTION_EMAIL_START_DATE', false),
    ],
    'userStatuses' => [
        'unconfirmed' => 'Unconfirmed',
        'confirmed' => 'Confirmed',
        'banned' => 'Banned'
    ],
    'exchange_rates' => [
        'BTC' => 0.00001,
        'ETH' => 0.0001
    ],
    'paprica' => [
        'DGB' => 'dgb-digibyte',
        'XMR' => 'xmr-monero',
        'BTC' => 'btc-bitcoin',
        'LTC' => 'ltc-litecoin',
        'DSH' => 'dash-dash',
        'ETH' => 'eth-ethereum',
        'EOS' => 'eos-eos',
        'XRP' => 'xrp-xrp',
        'NEO' => 'neo-neo',
        'OMG' => 'omg-omisego',
        'TUBE' => 'tube-bittube',
        'DOGE' => 'doge-dogecoin',
        'STEEM' => 'steem-steem',
        'THR' => 'thr-thorecoin',
        'RVN' => 'rvn-ravencoin',
        'BAT' => 'bat-basic-attention-token',
    ], 
    'pair_exchange'=>[
        'BTC/USD'=>'BITFINEX',
        'ETH/USD'=>'BITFINEX',
        'LTC/USD'=>'BITFINEX',
        'XRP/USD'=>'BITFINEX',
        'EOS/USD'=>'BITFINEX',
        'DSH/USD'=>'BITFINEX',
        'XMR/USD'=>'BITFINEX',
        'NEO/USD'=>'BITFINEX',
        'OMG/USD'=>'BITFINEX',
        'TUBE/BTC'=>'BITREX', //tube usd not available
        'DGB/BTC'=>'BITREX',
        'DOGE/BTC'=>'BITREX',
        'STEEM/BTC'=>'BINANCE',
        'THR/BTC'=>'CREX24',
        'BAT/BTC'=>'BINANCE',
        'RVN/BTC'=>'BINANCE',
        'APPL/USD'=>'NYSE',
    ],     
    'allowed_goals' => [
        'crypto-twice', 
        'steem',
        'uzdarbis',
        'panamacrypto',
        'digibyte',
        'bitboy', 
        'teamtronics', 
        'ravencoin', 
        'thecryptocurator', 
        'blockchain-futurist-conference'
    ],
    'trading_view' => [ 
        'ETH' => [
            'exchange'=>'BITFINEX',
            'pair'=>'ETHUSD',
        ],
        'LTC' => [
            'exchange'=>'BITFINEX',
            'pair'=>'LTCUSD',
        ],
        'BTC' => [
            'exchange'=>'BITFINEX',
            'pair'=>'BTCUSD',
        ],
        'XRP' => [
            'exchange'=>'BITFINEX',
            'pair'=>'XRPUSD',
        ],
        'EOS' => [
            'exchange'=>'BITFINEX',
            'pair'=>'EOSUSD',
        ],
        'DSH' => [
            'exchange'=>'BITFINEX',
            'pair'=>'DSHUSD',
        ],
        'XMR' => [
            'exchange'=>'BITFINEX',
            'pair'=>'XMRUSD',
        ],
        'NEO' => [
            'exchange'=>'BITFINEX',
            'pair'=>'NEOUSD',
        ],
        'OMG' => [
            'exchange'=>'BITFINEX',
            'pair'=>'OMGUSD',
        ],
        'TUBE' => [
            'exchange'=>'BITTREX',
            'pair'=>'TUBEBTC',
        ], 
        'DGB' => [
            'exchange'=>'BITFINEX',
            'pair'=>'DGBUSD',
        ],
        'DOGE' => [
            'exchange'=>'BITTREX',
            'pair'=>'DOGEBTC',
        ], 
        'STEEM' => [
            'exchange'=>'BINANCE',
            'pair'=>'STEEMBTC',
        ], 
        'THR' => [
            'exchange'=>'CREX24',
            'pair'=>'THRBTC', 
        ],  
        'BAT' => [
            'exchange'=>'BINANCE',
            'pair'=>'BATBTC',
        ],
        'RVN' => [
            'exchange'=>'BINANCE',
            'pair'=>'RVNBTC',
        ], 
        'AAPL' => [
            'exchange'=>'NASDAQ',
            'pair'=>'AAPL',
        ],  
        'EUR' => [
            'exchange'=>'CURRENCYCOM',
            'pair'=>'EURUSD',
        ],
        'AUD' => [
            'exchange'=>'CURRENCYCOM',
            'pair'=>'AUDUSD',
        ], 
        'GBP' => [
            'exchange'=>'CURRENCYCOM',
            'pair'=>'GBPUSD',
        ], 
        'NZD' => [
            'exchange'=>'CURRENCYCOM',
            'pair'=>'NZDUSD',
        ], 
        'AMZN' => [
            'exchange'=>'NASDAQ',
            'pair'=>'AMZN',
        ], 
        'NFLX' => [
            'exchange'=>'NASDAQ',
            'pair'=>'NFLX',
        ], 
        'GOOG' => [
            'exchange'=>'NASDAQ',
            'pair'=>'GOOG',
        ], 
        'JPM' => [
            'exchange'=>'NYSE',
            'pair'=>'JPM',
        ], 
        'MCD' => [
            'exchange'=>'NYSE',
            'pair'=>'MCD',
        ],   
        'TSLA' => [
            'exchange'=>'NASDAQ',
            'pair'=>'TSLA',
        ], 
        'MSFT' => [
            'exchange'=>'NASDAQ',
            'pair'=>'MSFT',
        ],                  
    ],   
    'currency_colors' => [
        'BTC' => '#ef9227', 
        'USD' => '#623869',
        'ETH' => '#4e7695',
        'LTC' => '#989898',
        'XRP' => '#989898',
        'EOS' => '#989898',
        'DSH' => '#989898',
        'XMR' => '#989898',
        'NEO' => '#989898',
        'OMG' => '#989898',
        'TUBE' => '#343434', 
        'DGB' => '#012351', 
        'DOGE' => '#989898', 
        'STEEM' => '#989898', 
        'THR' => '#989898', 
        'BAT' => '#989898', 
        'RVN' => '#989898', 
        'EUR' => '#989898', 
        'AUD' => '#989898', 
        'NZD' => '#989898', 
        'GBP' => '#989898', 
    ], 
    'perPage' => [
        'topTraders' => 30,
        'articlesFrontSubsystem' => 9,
        'competitionsArticlesPage' => 2,
        'tradeComments' => 5,
        'trades' => 10,
        'articleComments' => 10,
        'competitions' => 20,
        'rewards' => 10,
        'tradesFeed' => 5,
        'articles' => 2,
        'notifications' => 15,
        'notificationsBubble' => 4,
        'communityArticles' => 2,
        'relatedArticles' => 4
    ], 
    'starting_balance' => 4000,
    'social_networks' => ['facebook','twitter'],
    'notifications' => [
        'trade_orders',
        'comments',
        'newsletters',
        'signals',
        'new_follows',
        'votes',
        'direct_messages'
    ], 
    'crypto_currencies_link_types' => [
        'www' => 'WWW',
        'announcement' => 'Announcement',
        'source_code' => 'Source Code',
        'technical_documentation' => 'Technical documentation'
    ],
    'trade_fee_market' => 0.0025,
    'trade_fee_limit' => 0.0025,
    'trade_fee_stop' => 0.0025,
    'cryptocurrency_page_trade_description_min_length' => 150,
    'play_usd_btc_rate' => 100000000,
    'amount_to_satoshis' => 1000.0 * 1.0, 
    'satoshi_reward_per_thousand_play_dollars' => 100,     
    'ref_code_expire_time_in_mins' => 43200,
    'trader_badge_min_trades' => 30,
    'trader_badge_min_profit' => 25000,
    'trader_badge_min_avg_profit' => 1.5
]; 

}else{

return [
    'admin' => [
        'itemsPerPage' => 20
    ],
    'userRetention' => [
        'startDate' => env('USER_RETENTION_EMAIL_START_DATE', false),
    ],
    'userStatuses' => [
        'unconfirmed' => 'Unconfirmed',
        'confirmed' => 'Confirmed',
        'banned' => 'Banned'
    ],
    'exchange_rates' => [
        'BTC' => 0.00001,
        'ETH' => 0.0001
    ],
    'paprica' => [
        'DGB' => 'dgb-digibyte',
        'XMR' => 'xmr-monero',
        'BTC' => 'btc-bitcoin',
        'LTC' => 'ltc-litecoin',
        'DSH' => 'dash-dash',
        'ETH' => 'eth-ethereum',
        'EOS' => 'eos-eos',
        'XRP' => 'xrp-xrp',
        'NEO' => 'neo-neo',
        'OMG' => 'omg-omisego',
        'TUBE' => 'tube-bittube',
        'DOGE' => 'doge-dogecoin',
        'STEEM' => 'steem-steem',
        'THR' => 'thr-thorecoin',
        'RVN' => 'rvn-ravencoin',
        'BAT' => 'bat-basic-attention-token',
        'BNB' => 'bnb-binance-coin',
        'ADA' => 'ada-cardano',
        'DOT' => 'dot-polkadot',
        'LINK' => 'link-chainlink',
        'XLM' => 'xlm-stellar', 
        'BCH' => 'bch-bitcoin-cash',
    ],
    'pair_exchange'=>[
        'BTC/USD'=>'BITFINEX',
        'ETH/USD'=>'BITFINEX',
        'LTC/USD'=>'BITFINEX',
        'XRP/USD'=>'BITFINEX',
        'EOS/USD'=>'BITFINEX',
        'DSH/USD'=>'BITFINEX',
        'XMR/USD'=>'BITFINEX',
        'NEO/USD'=>'BITFINEX',
        'OMG/USD'=>'BITFINEX',
        'TUBE/BTC'=>'BITREX', //tube usd not available
        'DGB/BTC'=>'BITREX',
        'DOGE/BTC'=>'BITREX',
        'STEEM/BTC'=>'BINANCE',
        'THR/BTC'=>'CREX24',
        'BAT/BTC'=>'BINANCE',
        'RVN/BTC'=>'BINANCE',
        'BNB/USD'=>'BINANCE',
        'DOT/USD'=>'BINANCE',
        'LINK/USD'=>'BINANCE',
        'BCH/USD'=>'BINANCE',
        'ADA/USD'=>'BINANCE',
        'XLM/USD'=>'BINANCE',
    ],     
    'allowed_goals' => [
        'crypto-twice', 
        'steem',
        'uzdarbis',
        'panamacrypto',
        'digibyte',
        'bitboy', 
        'teamtronics', 
        'ravencoin', 
        'thecryptocurator', 
        'blockchain-futurist-conference'
    ],
    'trading_view' => [ 
        'ETH' => [
            'exchange'=>'BITFINEX',
            'pair'=>'ETHUSD',
        ],
        'LTC' => [
            'exchange'=>'BITFINEX',
            'pair'=>'LTCUSD',
        ],
        'BTC' => [
            'exchange'=>'BITFINEX',
            'pair'=>'BTCUSD',
        ],
        'XRP' => [
            'exchange'=>'BITFINEX',
            'pair'=>'XRPUSD',
        ],
        'EOS' => [
            'exchange'=>'BITFINEX',
            'pair'=>'EOSUSD',
        ],
        'DSH' => [
            'exchange'=>'BITFINEX',
            'pair'=>'DSHUSD',
        ],
        'XMR' => [
            'exchange'=>'BITFINEX',
            'pair'=>'XMRUSD',
        ],
        'NEO' => [
            'exchange'=>'BITFINEX',
            'pair'=>'NEOUSD',
        ],
        'OMG' => [
            'exchange'=>'BITFINEX',
            'pair'=>'OMGUSD',
        ],
        'TUBE' => [
            'exchange'=>'BITTREX',
            'pair'=>'TUBEBTC',
        ], 
        'DGB' => [
            'exchange'=>'BITFINEX',
            'pair'=>'DGBUSD',
        ],
        'DOGE' => [
            'exchange'=>'BITTREX',
            'pair'=>'DOGEBTC',
        ], 
        'STEEM' => [
            'exchange'=>'BINANCE',
            'pair'=>'STEEMBTC',
        ], 
        'THR' => [
            'exchange'=>'CREX24',
            'pair'=>'THRBTC', 
        ],  
        'BAT' => [
            'exchange'=>'BINANCE',
            'pair'=>'BATBTC',
        ],
        'RVN' => [
            'exchange'=>'BINANCE',
            'pair'=>'RVNBTC',
        ],  
        'BNB' => [
            'exchange'=>'BINANCE',
            'pair'=>'BNBUSDT',
        ],   
        'ADA' => [
            'exchange'=>'BINANCE',
            'pair'=>'ADAUSDT',
        ], 
        'LINK' => [
            'exchange'=>'BINANCE',
            'pair'=>'LINKUSDT',
        ],  
        'BCH' => [
            'exchange'=>'BINANCE',
            'pair'=>'BCHUSDT',
        ],
        'DOT' => [
            'exchange'=>'BINANCE',
            'pair'=>'DOTUSDT',
        ],
        'XLM' => [
            'exchange'=>'BINANCE',
            'pair'=>'XLMUSDT',
        ],           
    ],  
    'currency_colors' => [
        'BTC' => '#ef9227', 
        'USD' => '#623869',
        'ETH' => '#4e7695',
        'LTC' => '#989898',
        'XRP' => '#989898',
        'EOS' => '#989898',
        'DSH' => '#989898',
        'XMR' => '#989898',
        'NEO' => '#989898',
        'OMG' => '#989898',
        'TUBE' => '#343434', 
        'DGB' => '#012351', 
        'DOGE' => '#989898', 
        'STEEM' => '#989898', 
        'THR' => '#989898', 
        'BAT' => '#989898', 
        'RVN' => '#989898', 
        'BNB' => '#989898', 
        'ADA' => '#989898', 
        'LINK' => '#989898', 
        'BCH' => '#989898', 
        'DOT' => '#989898', 
        'XLM' => '#989898', 
    ],
    'perPage' => [
        'topTraders' => 20,
        'articlesFrontSubsystem' => 9,
        'competitionsArticlesPage' => 2,
        'tradeComments' => 5,
        'trades' => 10,
        'articleComments' => 10,
        'competitions' => 20,
        'rewards' => 10,
        'tradesFeed' => 5,
        'articles' => 2,
        'notifications' => 15,
        'notificationsBubble' => 4,
        'communityArticles' => 2,
        'relatedArticles' => 4
    ], 
    'starting_balance' => 100000,
    'social_networks' => ['facebook','twitter'],
    'notifications' => [
        'trade_orders',
        'comments',
        'newsletters',
        'signals',
        'new_follows',
        'votes',
        'direct_messages'
    ], 
    'crypto_currencies_link_types' => [
        'www' => 'WWW',
        'announcement' => 'Announcement',
        'source_code' => 'Source Code',
        'technical_documentation' => 'Technical documentation'
    ],
    'trade_fee_market' => 0.0025,
    'trade_fee_limit' => 0.0025,
    'trade_fee_stop' => 0.0025,
    'cryptocurrency_page_trade_description_min_length' => 150,
    'play_usd_btc_rate' => 100000000,
    'amount_to_satoshis' => 1000.0 * 1.0, 
    'satoshi_reward_per_thousand_play_dollars' => 100,     
    'ref_code_expire_time_in_mins' => 43200,
    'trader_badge_min_trades' => 30,
    'trader_badge_min_profit' => 25000,
    'trader_badge_min_avg_profit' => 1.5
]; 

}