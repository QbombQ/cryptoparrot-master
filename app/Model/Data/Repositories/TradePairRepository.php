<?php

namespace App\Model\Data\Repositories;

use App\Model\Contracts\Interfaces\Data\TradePairRepositoryInterface;
use App\Model\Data\Models\TradePair;

class TradePairRepository implements TradePairRepositoryInterface
{

    public function all()
    {

        return TradePair::orderBy('id', 'asc')->get();

    }

    public function enabled()
    {

        return TradePair::where('disabled', 0)->orderBy('priority', 'desc')->get();

    }


    public function getForCurrenciesPage()
    {

        return TradePair::where('show_on_currencies_page', 1)->orderBy('id', 'asc')->get();

    }

    public function getByIds($fromId, $toId)
    {

        return TradePair::where([
            ['from_currency_id', '=', $fromId],
            ['to_currency_id', '=', $toId]
        ])->orWhere([
            ['from_currency_id', '=', $toId],
            ['to_currency_id', '=', $fromId]
        ])->first();

    }


    public function paginate($limit)
    {

        return TradePair::orderBy('id', 'asc')->paginate($limit);

    }    


    public function create($args)
    {

        $pair = new TradePair;
        $pair->fill($args);
        $pair->save();
        
        return $pair->id;

    }       

    public function update($id, $data)
    {

        $pair = TradePair::find($id);
        $pair->update($data);

    }

    public function get($id)
    {

        return TradePair::findOrFail($id);

    }

}