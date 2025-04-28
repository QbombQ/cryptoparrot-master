<?php

namespace App\Model\Data\Repositories;

use App\Model\Contracts\Interfaces\Data\TradeVoteRepositoryInterface;
use App\Model\Data\Models\TradeVote;

class TradeVoteRepository implements TradeVoteRepositoryInterface
{

    public function vote($userId, $tradeId)
    {

        $vote = new TradeVote;
        $vote->user_id = $userId;
        $vote->trade_id = $tradeId;
        $vote->save();

    }

    public function voted($userId, $tradeId)
    {

        $vote = TradeVote::where([
            'user_id' => $userId,
            'trade_id' => $tradeId
        ])->first();

        return $vote ? true : false;

    }

    public function delete($userId, $tradeId)
    {

        $tradeVote = TradeVote::where([
            'user_id' => $userId,
            'trade_id' => $tradeId
        ])->first();

        if($tradeVote)
        {

            $tradeVote->delete();
            
        }

    }    

}