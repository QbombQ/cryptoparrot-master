<?php

namespace App\Model\Data\Repositories;

use App\Model\Contracts\Interfaces\Data\BadgeRepositoryInterface;
use App\Model\Data\Models\Badge;
use App\Model\Data\Models\UserBadge;

class BadgeRepository implements BadgeRepositoryInterface
{

    public function giveBadge($data)
    {

        $existingBadge = UserBadge::where('user_id', $data['user_id'])->where('badge_id', $data['badge_id'])->first();

        if($existingBadge) return;

        $badge = new UserBadge;
        $badge->fill($data);
        $badge->save();

    }

    public function all()
    {

        return Badge::all();

    }


    public function paginate($limit)
    {

        return Badge::orderBy('id', 'desc')->paginate($limit);

    }

    public function create($data)
    {

        $badge = new Badge;
        $badge->fill($data);
        $badge->save();

    }

    public function update($badgeId, $data)
    {

        $badge = Badge::find($badgeId);

        if($badge)
        {

            $badge->fill($data);
            $badge->save();
            return $badge->id;
            
        }

    }          

    public function getById($id)
    {

        return Badge::findOrFail($id);

    }

}