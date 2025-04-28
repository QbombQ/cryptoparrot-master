<?php

namespace App\Http\Controllers\AdminSubsystem;

use App\Http\Controllers\AdminSubsystem\BaseAdminSubsystemController;
use App\Model\Contracts\Interfaces\Services\AdminSubsystem\ArticleCategoryServiceInterface;
use Illuminate\Http\Request;

class CategoryPageController extends BaseAdminSubsystemController
{

	protected $articleCategoryService;
	
	const REDIRECT_TO_AFTER_ACTION = '/admin/categories';

    public function __construct(
        ArticleCategoryServiceInterface $articleCategoryService
    )
    {

		parent::__construct('categories');
        $this->articleCategoryService = $articleCategoryService;

    }
	
	public function main()
	{
    
		return view($this->viewWithPrefix('new'));		
		
	}

	public function create(Request $request)
    {

        $response = $this->articleCategoryService->create($request->all());

		return is_string($response) ? // String means success message
				redirect(self::REDIRECT_TO_AFTER_ACTION)->with('message', $response) :
				back()->withInput()->withErrors($response);

	}
	
	public function edit($categoryId)
    {

		$this->data['category'] = $this->articleCategoryService->getForEdit($categoryId);
		
        return view($this->viewWithPrefix('edit'), $this->data);	

	}
	
	public function update(Request $request)
    {

        $response = $this->articleCategoryService->update($request->all());

		return is_string($response) ? // String means success message
				redirect(self::REDIRECT_TO_AFTER_ACTION)->with('message', $response) :
				back()->withInput()->withErrors($response);

	}    
	
	public function delete($categoryId)
    {

        $response = $this->articleCategoryService->delete($categoryId);

		return is_string($response) ? // String means success message
				redirect(self::REDIRECT_TO_AFTER_ACTION)->with('message', $response) :
				back()->withInput()->withErrors($response);

    }

}