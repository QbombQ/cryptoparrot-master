<?php

namespace App\Model\Data\Repositories;

use App\Model\Contracts\Interfaces\Data\SponsorRepositoryInterface;
use App\Model\Data\Models\Sponsor;

class SponsorRepository implements SponsorRepositoryInterface
{

    public function paginate($limit = 10)
    {

        return Sponsor::orderBy('updated_at', 'desc')->paginate($limit);

    }

    public function create($args)
    {

        $sponsor = new Sponsor;
        $sponsor->fill($args);
        $sponsor->save();

        return $sponsor->id;

    }

    public function update($sponsorId, $data)
    {

        $sponsor = Sponsor::find($sponsorId);

        if($sponsor)
        {

            $sponsor->fill($data);
            $sponsor->save();

        }

    }   

    public function getById($sponsorId)
    {

        return Sponsor::findOrFail($sponsorId);

    }

    public function delete($sponsorId)
    {

        $sponsor = Sponsor::findOrFail($sponsorId);

        if($sponsor)
        {

            $sponsor->delete();
            return true;

        }
        
        return false;

    }
    
    public function all()
    {

        return Sponsor::all();

    }

}