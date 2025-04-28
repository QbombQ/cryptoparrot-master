<?php

namespace App\Http\Controllers\AdminSubsystem;

use App\Http\Controllers\AdminSubsystem\BaseAdminSubsystemController;
use App\Model\Contracts\Interfaces\Services\AdminSubsystem\ArticleCategoryServiceInterface;
use App\Model\Contracts\Interfaces\Services\AdminSubsystem\ArticleServiceInterface;
use Illuminate\Http\Request;

class ArticlePageController extends BaseAdminSubsystemController
{

    protected $articleService;
    protected $articleCategoryService;

    const REDIRECT_TO_AFTER_ACTION = '/admin/articles';

    public function __construct(
        ArticleServiceInterface $articleService,
        ArticleCategoryServiceInterface $articleCategoryService
    )
    {

        parent::__construct('articles');
        $this->articleService = $articleService;
        $this->articleCategoryService = $articleCategoryService;

    }
	
	public function main()
	{

        $this->data['categories'] = $this->articleCategoryService->getForSelect();

		return view($this->viewWithPrefix('new'), $this->data);		
		
    }

    public function edit($articleId)
    {

        $this->data['categories'] = $this->articleCategoryService->getForSelect();
        $this->data['article'] = $this->articleService->getForEdit($articleId);
        
        return view($this->viewWithPrefix('edit'), $this->data);	

    }
    
    public function create(Request $request)
    {

        $response = $this->articleService->create($request->all());

		return is_string($response) ? // String means success message
				redirect(self::REDIRECT_TO_AFTER_ACTION)->with('message', $response) :
				back()->withInput()->withErrors($response);

    }

    public function update(Request $request)
    {

        $response = $this->articleService->update($request->all());

		return is_string($response) ? // String means success message
				redirect(self::REDIRECT_TO_AFTER_ACTION)->with('message', $response) :
				back()->withInput()->withErrors($response);

    }    

    public function delete($articleId)
    {

        $response = $this->articleService->delete($articleId);

		return is_string($response) ? // String means success message
				redirect(self::REDIRECT_TO_AFTER_ACTION)->with('message', $response) :
				back()->withInput()->withErrors($response);

    }

}