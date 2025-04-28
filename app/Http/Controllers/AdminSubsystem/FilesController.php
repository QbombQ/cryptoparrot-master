<?php

namespace App\Http\Controllers\AdminSubsystem;

use App\Http\Controllers\AdminSubsystem\BaseAdminSubsystemController;
use App\Model\Contracts\Interfaces\Services\Common\FileServiceInterface;
use Illuminate\Http\Request;

class FilesController extends BaseAdminSubsystemController
{

    protected $fileService;

    public function __construct(
        FileServiceInterface $fileService
    )
    {
        $this->fileService = $fileService;
    }
	
	public function uploadCkEditorFile(Request $request)
	{
        
		return $this->fileService->uploadCkEditorFile($request);
		
	}

}