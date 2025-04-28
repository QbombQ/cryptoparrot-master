<?php

namespace App\Model\Services\AdminSubsystem;

use App\Model\Contracts\Interfaces\Services\AdminSubsystem\SponsorServiceInterface;
use App\Model\Contracts\Interfaces\Formatters\AdminSubsystem\SponsorFormatterInterface;
use App\Model\Contracts\Interfaces\Validators\AdminSubsystem\SponsorValidatorInterface;
use App\Model\Contracts\Interfaces\Data\SponsorRepositoryInterface;
use App\Model\Contracts\Interfaces\Services\Common\FileServiceInterface;

class SponsorService implements SponsorServiceInterface
{

    protected $sponsorRepository;
    protected $sponsorFormatter;
    protected $sponsorValidator;
    protected $fileService;

    public function __construct(
        SponsorRepositoryInterface $sponsorRepository,
        SponsorFormatterInterface $sponsorFormatter,
        FileServiceInterface $fileService,
        SponsorValidatorInterface $sponsorValidator
    )
    {

        $this->sponsorRepository = $sponsorRepository;
        $this->sponsorFormatter = $sponsorFormatter;
        $this->sponsorValidator = $sponsorValidator;
        $this->fileService = $fileService;

    }    

    public function all()
    {

        $sponsors = $this->sponsorRepository->all();

        return $this->sponsorFormatter->prepareSponsorsForSelect($sponsors);        

    }

    public function paginate($limit)
    {

        $sponsors = $this->sponsorRepository->paginate($limit);

        return $this->sponsorFormatter->prepareSponsorsForDisplay($sponsors);        

    }

    public function create($data)
    {

        if(!$this->sponsorValidator->validateCreate($data))
        {

            return $this->sponsorValidator->getErrors();

        }

        $sponsorId = $this->sponsorRepository->create(
            $this->sponsorFormatter->prepareDataForCreation($data)
        );    

        if(array_key_exists('logo', $data))
        {

            $path = $this->fileService->uploadSponsorLogo($data['logo'], $sponsorId);
            $this->sponsorRepository->update($sponsorId, ['logo' => $path]);

        }

        return trans('AdminSubsystem/success-messages.sponsor-creation-success');        

    }  
    
    public function edit($data)
    {

        if(!$this->sponsorValidator->validateUpdate($data))
        {

            return $this->sponsorValidator->getErrors();

        }

        $this->sponsorRepository->update(
            $data['sponsor_id'],
            $this->sponsorFormatter->prepareDataForUpdate($data)
        );    

        if(array_key_exists('logo', $data))
        {

            $path = $this->fileService->uploadSponsorLogo($data['logo'], $data['sponsor_id']);
            $this->sponsorRepository->update($data['sponsor_id'], ['logo' => $path]);

        }

        return trans('AdminSubsystem/success-messages.sponsor-update-success');      

    }

    public function getForEdit($sponsorId)
    {

        $sponsor = $this->sponsorRepository->getById($sponsorId);

        return $this->sponsorFormatter->prepareSponsorForEdit($sponsor);        

    }

    public function delete($sponsorId)
    {

        $deleted = $this->sponsorRepository->delete($sponsorId);

        if($deleted)
        {

            $this->fileService->deleteSponsorLogos($sponsorId);
            
            return trans('AdminSubsystem/success-messages.sponsor-delete-success');
            
        }

        return [];

    }

}