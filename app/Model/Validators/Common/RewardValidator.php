<?php

namespace App\Model\Validators\Common;

use App\Model\Contracts\Interfaces\Validators\Common\RewardValidatorInterface;
use Illuminate\Support\Facades\Validator;
use App\Rules\EnoughFunds;
use App\Rules\CanOrderReward;
use App;

class RewardValidator implements RewardValidatorInterface
{

    protected $validator;

    public function validateCreation($data)
    {

		$this->validator = Validator::make($data, [
            'user_id' => 'required|exists:users,id',
            'reward_id' => 'required|exists:rewards,id',
            'full_name' => 'required|string',
            'address_line_1' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string',
            'postcode' => 'required|string',
            'accept' => 'required|in:on'
        ],[
            'accept.in' => 'You must accept terms and conditions',
            'accept.required' => 'You must accept terms and conditions',
        ]);

        if($this->validator->fails())
        {

            return false;

        }

        $rewardRepository = App::make('App\Model\Contracts\Interfaces\Data\RewardRepositoryInterface');
        $reward = $rewardRepository->get($data['reward_id']);
        $data['price'] = $reward->price;

        $this->validator = Validator::make($data, [
            'price' => [new EnoughFunds(), new CanOrderReward()],
        ]);

		return !$this->validator->fails();

    }    

    public function getErrors()
    {
        
        if(!$this->validator) return null;
        
        return $this->validator;

    }

}