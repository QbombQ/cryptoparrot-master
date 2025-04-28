<?php

namespace App\Model\Services\AdminSubsystem;

use App\Model\Contracts\Interfaces\Services\AdminSubsystem\BadgeServiceInterface;
use App\Model\Contracts\Interfaces\Formatters\AdminSubsystem\BadgeFormatterInterface;
use App\Model\Contracts\Interfaces\Validators\AdminSubsystem\BadgeValidatorInterface;
use App\Model\Contracts\Interfaces\Data\BadgeRepositoryInterface;

class BadgeService implements BadgeServiceInterface
{

    protected $badgeRepository;
    protected $badgeFormatter;
    protected $badgeValidator;

    public function __construct(
        BadgeRepositoryInterface $badgeRepository,
        BadgeFormatterInterface $badgeFormatter,
        BadgeValidatorInterface $badgeValidator
    )
    {

        $this->badgeRepository = $badgeRepository;
        $this->badgeFormatter = $badgeFormatter;
        $this->badgeValidator = $badgeValidator;

    }    

    public function all()
    {

        $badges = $this->badgeRepository->all();

        return $this->badgeFormatter->prepareBadgesForSelect($badges);        

    }

    public function paginate($limit)
    {

        $badges = $this->badgeRepository->paginate($limit);

        return $this->badgeFormatter->prepareBadgesForDisplay($badges);        

    }

    public function create($data)
    {

        if(!$this->badgeValidator->validateCreate($data))
        {

            return $this->badgeValidator->getErrors();

        }

        $this->badgeRepository->create(
            $this->badgeFormatter->prepareDataForCreation($data)
        );    

        return trans('AdminSubsystem/success-messages.badge-creation-success');        

    }  

    public function give($data)
    {

        if(!$this->badgeValidator->validateGive($data))
        {

            return $this->badgeFormatter->prepareGiveResponseWithError($this->badgeValidator->getErrors()->errors()->first());

        }

        $this->badgeRepository->giveBadge(
            [
                'user_id' => $data['user_id'],
                'badge_id' => $data['badge_id']
            ]
        );        

        return $this->badgeFormatter->prepareGiveResponse(trans('AdminSubsystem/success-messages.badge-give-success')); 

    }
    
    public function edit($data)
    {

        if(!$this->badgeValidator->validateUpdate($data))
        {

            return $this->badgeValidator->getErrors();
            
        }

        $this->badgeRepository->update(
            $data['badge_id'],
            $this->badgeFormatter->prepareDataForUpdate($data)
        );    

        return trans('AdminSubsystem/success-messages.badge-update-success');      

    }

    public function getForEdit($badgeId)
    {

        $badge = $this->badgeRepository->getById($badgeId);
        
        return $this->badgeFormatter->prepareForEdit($badge);        

    }

}