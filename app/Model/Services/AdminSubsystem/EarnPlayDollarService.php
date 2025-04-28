<?php

namespace App\Model\Services\AdminSubsystem;

use App\Model\Contracts\Interfaces\Services\AdminSubsystem\EarnPlayDollarServiceInterface;
use App\Model\Contracts\Interfaces\Formatters\AdminSubsystem\EarnPlayDollarFormatterInterface;
use App\Model\Contracts\Interfaces\Validators\AdminSubsystem\EarnPlayDollarValidatorInterface;
use App\Model\Contracts\Interfaces\Data\EarnPlayDollarRepositoryInterface;
use App\Model\Contracts\Interfaces\Services\Common\FileServiceInterface;

class EarnPlayDollarService implements EarnPlayDollarServiceInterface
{

    protected $earnPlayDollarRepository;
    protected $earnPlayDollarFormatter;
    protected $earnPlayDollarValidator;
    protected $fileService;

    public function __construct(
        EarnPlayDollarRepositoryInterface $earnPlayDollarRepository,
        EarnPlayDollarFormatterInterface $earnPlayDollarFormatter,
        FileServiceInterface $fileService,
        EarnPlayDollarValidatorInterface $earnPlayDollarValidator
    )
    {

        $this->earnPlayDollarRepository = $earnPlayDollarRepository;
        $this->earnPlayDollarFormatter = $earnPlayDollarFormatter;
        $this->earnPlayDollarValidator = $earnPlayDollarValidator;
        $this->fileService = $fileService;

    }    

    public function paginate($limit)
    {

        $earnPlayDollars = $this->earnPlayDollarRepository->paginate($limit);

        return $this->earnPlayDollarFormatter->prepareEarnPlayDollarsForDisplay($earnPlayDollars);        

    }

    public function create($data)
    {

        if(!$this->earnPlayDollarValidator->validateCreate($data))
        {

            return $this->earnPlayDollarValidator->getErrors();

        }

        $earnPlayDollarId = $this->earnPlayDollarRepository->create(
            $this->earnPlayDollarFormatter->prepareDataForCreation($data)
        );    

        if(array_key_exists('image', $data))
        {

            $path = $this->fileService->uploadEarnPlayDollarLogo($data['image'], $earnPlayDollarId);
            $this->earnPlayDollarRepository->update($earnPlayDollarId, ['image' => $path]);

        }

        return trans('AdminSubsystem/success-messages.earnPlayDollar-creation-success');        

    }  
    
    public function edit($data)
    {

        if(!$this->earnPlayDollarValidator->validateUpdate($data))
        {

            return $this->earnPlayDollarValidator->getErrors();

        }

        $this->earnPlayDollarRepository->update(
            $data['earnPlayDollar_id'],
            $this->earnPlayDollarFormatter->prepareDataForUpdate($data)
        );    

        if(array_key_exists('image', $data))
        {

            $path = $this->fileService->uploadEarnPlayDollarLogo($data['image'], $data['earnPlayDollar_id']);
            $this->earnPlayDollarRepository->update($data['earnPlayDollar_id'], ['image' => $path]);

        }

        return trans('AdminSubsystem/success-messages.earnPlayDollar-update-success');      

    }

    public function getForEdit($earnPlayDollarId)
    {

        $earnPlayDollar = $this->earnPlayDollarRepository->getById($earnPlayDollarId);

        return $this->earnPlayDollarFormatter->prepareEarnPlayDollarForEdit($earnPlayDollar);        

    }

    public function delete($earnPlayDollarId)
    {

        $deleted = $this->earnPlayDollarRepository->delete($earnPlayDollarId);

        if($deleted)
        {

            $this->fileService->deleteEarnPlayDollarLogos($earnPlayDollarId);
            
            return trans('AdminSubsystem/success-messages.earnPlayDollar-delete-success');
            
        }

        return [];

    }

}