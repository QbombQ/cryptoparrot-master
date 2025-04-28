<?php

namespace App\Model\Services\AdminSubsystem;

use App\Model\Contracts\Interfaces\Services\AdminSubsystem\RewardServiceInterface;
use App\Model\Contracts\Interfaces\Formatters\AdminSubsystem\RewardFormatterInterface;
use App\Model\Contracts\Interfaces\Validators\AdminSubsystem\RewardValidatorInterface;
use App\Model\Contracts\Interfaces\Data\RewardRepositoryInterface;
use App\Model\Contracts\Interfaces\Services\Common\FileServiceInterface;

class RewardService implements RewardServiceInterface
{

    protected $rewardRepository;
    protected $rewardFormatter;
    protected $rewardValidator;
    protected $fileService;

    public function __construct(
        RewardRepositoryInterface $rewardRepository,
        RewardFormatterInterface $rewardFormatter,
        FileServiceInterface $fileService,
        RewardValidatorInterface $rewardValidator
    )
    {

        $this->rewardRepository = $rewardRepository;
        $this->rewardFormatter = $rewardFormatter;
        $this->rewardValidator = $rewardValidator;
        $this->fileService = $fileService;

    }    

    public function updateUserRewardStatus($data)
    {

        if(!$this->rewardValidator->validateStatusChange($data))
        {

            return $this->rewardFormatter->prepareFailResponse($this->rewardValidator->getErrors()->errors()->first());

        }

        $reward = $this->rewardRepository->getUserReward($data['reward_id']);
        $reward->status = $data['status'];
        $reward->save();

        return $this->rewardFormatter->prepareSuccessResponse(trans('AdminSubsystem/success-messages.updated'));

    }

    public function paginate($limit)
    {

        $rewards = $this->rewardRepository->paginate($limit);

        return $this->rewardFormatter->prepareRewardsForDisplay($rewards);        

    }

    public function paginateUserRewards($limit)
    {

        $userRewards = $this->rewardRepository->paginateUserRewards($limit);

        return $this->rewardFormatter->prepareUserRewardsForDisplay($userRewards);        

    }

    public function create($data)
    {

        if(!$this->rewardValidator->validateCreate($data))
        {

            return $this->rewardValidator->getErrors();

        }

        $rewardId = $this->rewardRepository->create(
            $this->rewardFormatter->prepareDataForCreation($data)
        );    

        if(array_key_exists('image', $data))
        {

            $path = $this->fileService->uploadRewardLogo($data['image'], $rewardId);
            $this->rewardRepository->update($rewardId, ['image' => $path]);

        }

        return trans('AdminSubsystem/success-messages.reward-creation-success');        

    }  
    
    public function edit($data)
    {

        if(!$this->rewardValidator->validateUpdate($data))
        {

            return $this->rewardValidator->getErrors();

        }

        $this->rewardRepository->update(
            $data['reward_id'],
            $this->rewardFormatter->prepareDataForUpdate($data)
        );    

        if(array_key_exists('image', $data))
        {

            $path = $this->fileService->uploadRewardLogo($data['image'], $data['reward_id']);
            $this->rewardRepository->update($data['reward_id'], ['image' => $path]);

        }

        return trans('AdminSubsystem/success-messages.reward-update-success');      

    }

    public function getForEdit($rewardId)
    {

        $reward = $this->rewardRepository->getById($rewardId);
        
        return $this->rewardFormatter->prepareRewardForEdit($reward);        

    }

    public function delete($rewardId)
    {

        $deleted = $this->rewardRepository->delete($rewardId);

        if($deleted)
        {

            $this->fileService->deleteRewardLogos($rewardId);
            return trans('AdminSubsystem/success-messages.reward-delete-success');
            
        }

        return [];

    }

}