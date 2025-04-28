<?php

namespace App\Http\Controllers\AdminSubsystem;

use App\Http\Controllers\AdminSubsystem\BaseAdminSubsystemController;
use App\Model\Contracts\Interfaces\Services\AdminSubsystem\ArticleServiceInterface;

class ArticlesPageController extends BaseAdminSubsystemController
{

    protected $articleService;

    public function __construct(
        ArticleServiceInterface $articleService
    )
    {

        parent::__construct('articles');
        $this->articleService = $articleService;

    }
	
	public function main()
	{
        
        $this->data['articles'] = $this->articleService->paginate(config('custom.admin.itemsPerPage'));
        
		return view($this->viewWithPrefix('articles'), $this->data);		
		
	}

}