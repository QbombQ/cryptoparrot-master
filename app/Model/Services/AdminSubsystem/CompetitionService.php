<?php

namespace App\Model\Services\AdminSubsystem;

use App\Model\Contracts\Interfaces\Services\AdminSubsystem\CompetitionServiceInterface;
use App\Model\Contracts\Interfaces\Services\AdminSubsystem\CompetitionPrizeServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\FileServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\BadgeServiceInterface;
use App\Model\Contracts\Interfaces\Formatters\AdminSubsystem\CompetitionFormatterInterface;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\CompetitionFormatterInterface as TradeSubsystemCompetitionFormatterInterface;
use App\Model\Contracts\Interfaces\Validators\AdminSubsystem\CompetitionValidatorInterface;
use App\Model\Contracts\Interfaces\Validators\AdminSubsystem\CompetitionPrizeValidatorInterface;
use App\Model\Contracts\Interfaces\Data\CompetitionRepositoryInterface;
use App\Model\Contracts\Interfaces\Data\CompetitionParticipantRepositoryInterface;
use App\Model\Contracts\Interfaces\Data\CompetitionBadgeRepositoryInterface;
use App\Model\Contracts\Interfaces\Data\UserRepositoryInterface;

class CompetitionService implements CompetitionServiceInterface
{

    protected $competitionRepository;
    protected $competitionBadgeRepository;
    protected $competitionFormatter;
    protected $competitionValidator;
    protected $fileService;
    protected $userRepository;
    protected $badgeService;
    protected $competitionParticipantRepository;
    protected $tradeSubsystemCompetitionFormatter;
    protected $competitionPrizeService;
    protected $competitionPrizeValidator;

    public function __construct(
        CompetitionRepositoryInterface $competitionRepository,
        CompetitionBadgeRepositoryInterface $competitionBadgeRepository,
        CompetitionFormatterInterface $competitionFormatter,
        CompetitionValidatorInterface $competitionValidator,
        FileServiceInterface $fileService,
        UserRepositoryInterface $userRepository,
        BadgeServiceInterface $badgeService,
        CompetitionParticipantRepositoryInterface $competitionParticipantRepository,
        TradeSubsystemCompetitionFormatterInterface $tradeSubsystemCompetitionFormatter,
        CompetitionPrizeServiceInterface $competitionPrizeService,
        CompetitionPrizeValidatorInterface $competitionPrizeValidator
    )
    {

        $this->competitionRepository = $competitionRepository;
        $this->competitionBadgeRepository = $competitionBadgeRepository;
        $this->competitionFormatter = $competitionFormatter;
        $this->competitionValidator = $competitionValidator;
        $this->fileService = $fileService;
        $this->userRepository = $userRepository;
        $this->badgeService = $badgeService;
        $this->competitionParticipantRepository = $competitionParticipantRepository;
        $this->tradeSubsystemCompetitionFormatter = $tradeSubsystemCompetitionFormatter;
        $this->competitionPrizeService = $competitionPrizeService;
        $this->competitionPrizeValidator = $competitionPrizeValidator;

    }

    public function paginate($limit)
    {

        $competitions = $this->competitionRepository->paginate($limit);

        return $this->competitionFormatter->prepareCompetitionsForDisplay($competitions);

    }

    public function getForSelect()
    {

        $competitions = $this->competitionRepository->all();
    
        return $this->competitionFormatter->prepareCompetitionsForSelect($competitions);

    }

    public function create($data)
    {

        if(!$this->competitionValidator->validateCreate($data))
        {

            return $this->competitionValidator->getErrors();

        }

        $competitionId = $this->competitionRepository->create(
            $this->competitionFormatter->prepareDataForCreation($data)
        );

        if(array_key_exists('badge', $data))
        {

            foreach($data['badge'] as $badge)
            {

                $this->competitionBadgeRepository->create([
                    'badge_id' => $badge,
                    'competition_id' => $competitionId
                ]);

            }

        }

        if(array_key_exists('logo', $data))
        {

            $path = $this->fileService->uploadCompetitionLogo($data['logo'], $competitionId);
            $this->competitionRepository->update($competitionId, $this->competitionFormatter->prepareDataForLogoUpdate($path));

        }


        if(array_key_exists('cover', $data))
        {

            $path = $this->fileService->uploadCompetitionCover($data['cover'], $competitionId);
            $this->competitionRepository->update($competitionId, $this->competitionFormatter->prepareDataForCoverUpdate($path));

        }

        return trans('AdminSubsystem/success-messages.competition-creation-success');        

    }

    public function register($data)
    {

        if(!array_key_exists('competition_id', $data) || !array_key_exists('goals', $data))
        {

            return trans('AdminSubsystem/error-messages.error');

        }

        $competition = $this->competitionRepository->getById($data['competition_id']);

        if(!$competition)
        {

            return trans('AdminSubsystem/error-messages.competition-does-not-exist');   

        }

        if($competition->status > 0)
        {
            
            return trans('AdminSubsystem/error-messages.competition-already-started');   

        }

        if($data['user_id'] != -1)
        {

            $k = 0;

            if($this->competitionParticipantRepository->userAlreadyParticipates($data['user_id'], $competition->id))
            {
                
                return trans('AdminSubsystem/error-messages.user-already-participates');

            }

            $this->competitionParticipantRepository->create(
                $this->tradeSubsystemCompetitionFormatter->prepareDataForCreation($competition->id, $data['user_id'])
            );
            $k++;

        }else{

            $users = $this->userRepository->getByRefCode($data['goals']);

            if($users->count() === 0)
            {
                
                return trans('AdminSubsystem/error-messages.no-users-have-ref-code');

            }

            $k = 0;

            foreach($users as $user)
            {

                if(!$this->badgeService->userHasBadges($user, $competition->badges))
                {
                    
                    continue;

                }

                if($this->competitionParticipantRepository->userAlreadyParticipates($user->id, $competition->id)) 
                {
                    
                    continue;

                }

                $this->competitionParticipantRepository->create(
                    $this->tradeSubsystemCompetitionFormatter->prepareDataForCreation($competition->id, $user->id)
                );
                $k++;

            }

        }
        return $k . trans('AdminSubsystem/success-messages.users-were-registered');       

    }    

    public function update($data)
    {

        if(!$this->competitionValidator->validateUpdate($data))
        {

            return $this->competitionValidator->getErrors();

        }

        $competitionId = $this->competitionRepository->update(
            $data['competition_id'],
            $this->competitionFormatter->prepareDataForUpdate($data)
        );

        $this->competitionBadgeRepository->deleteCompetitionBadges($data['competition_id']);

        if(array_key_exists('badge', $data))
        {

            foreach($data['badge'] as $badge)
            {

                $this->competitionBadgeRepository->create([
                    'badge_id' => $badge,
                    'competition_id' => $data['competition_id']
                ]);

            }

        }

        if(array_key_exists('logo', $data))
        {

            $path = $this->fileService->uploadCompetitionLogo($data['logo'], $competitionId);
            $this->competitionRepository->update($competitionId, $this->competitionFormatter->prepareDataForLogoUpdate($path));
            
        }  

 
        if(array_key_exists('cover', $data))
        {

            $path = $this->fileService->uploadCompetitionCover($data['cover'], $competitionId);
            $this->competitionRepository->update($competitionId, $this->competitionFormatter->prepareDataForCoverUpdate($path));
            
        }          
        

        return trans('AdminSubsystem/success-messages.competition-update-success');        

    }    

    public function getForEdit($competitionId)
    {

        $competition = $this->competitionRepository->getById($competitionId);
        
        return $this->competitionFormatter->prepareCompetitionForEdit($competition);

    }

}