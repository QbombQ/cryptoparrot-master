<?php

namespace App\Model\Data\Repositories;

use App\Model\Contracts\Interfaces\Data\EarnPlayDollarRepositoryInterface;
use App\Model\Data\Models\EarnPlayDollar;

class EarnPlayDollarRepository implements EarnPlayDollarRepositoryInterface
{

    public function paginate($limit)
    {

        return EarnPlayDollar::orderBy('updated_at', 'desc')->paginate($limit);

    }

    public function get($id)
    {

        return EarnPlayDollar::find($id);

    }

    public function create($args)
    {

        $earnPlayDollar = new EarnPlayDollar;
        $earnPlayDollar->fill($args);
        $earnPlayDollar->save();

        return $earnPlayDollar->id;

    }

    public function update($earnPlayDollarId, $data)
    {

        $earnPlayDollar = EarnPlayDollar::find($earnPlayDollarId);

        if($earnPlayDollar)
        {

            $earnPlayDollar->fill($data);
            $earnPlayDollar->save();

        }

    }   

    public function getById($earnPlayDollarId)
    {

        return EarnPlayDollar::findOrFail($earnPlayDollarId);

    }

    public function delete($earnPlayDollarId)
    {

        $earnPlayDollar = EarnPlayDollar::findOrFail($earnPlayDollarId);

        if($earnPlayDollar)
        {

            $earnPlayDollar->delete();
            return true;

        }
        
        return false;

    }

}