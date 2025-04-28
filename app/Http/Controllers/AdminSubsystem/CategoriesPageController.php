<?php

namespace App\Http\Controllers\AdminSubsystem;

use App\Http\Controllers\AdminSubsystem\BaseAdminSubsystemController;
use App\Model\Contracts\Interfaces\Services\AdminSubsystem\ArticleCategoryServiceInterface;

class CategoriesPageController extends BaseAdminSubsystemController
{

    protected $articleCategoryService;

    public function __construct(
        ArticleCategoryServiceInterface $articleCategoryService
    )
    {

        parent::__construct('categories');
        $this->articleCategoryService = $articleCategoryService;

    }
	
	public function main()
	{
        
        $this->data['categories'] = $this->articleCategoryService->paginate(config('custom.admin.itemsPerPage'));
        
		return view($this->viewWithPrefix('categories'), $this->data);		
		
	}

}