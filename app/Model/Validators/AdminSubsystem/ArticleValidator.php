<?php 

namespace App\Model\Validators\AdminSubsystem;

use App\Model\Contracts\Interfaces\Validators\AdminSubsystem\ArticleValidatorInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ArticleValidator implements ArticleValidatorInterface
{

    protected $validator;
	
	public function validateCreate($data)
	{

        $rules = [
            'title' => 'required|string|min:1',
            'url' => 'sometimes|nullable|url|max:190',
            'excerpt' => 'required|string|min:1|max:255',
            'content' => 'sometimes|required_without:url',
            'category' => 'required',
            'category.*' => 'integer|exists:article_categories,id',
            'thumbnail' => 'sometimes|file|mimetypes:image/jpeg,image/png|max:5000',
            'tags' => 'sometimes|nullable|string',
            'slug' => 'sometimes|nullable|string|max:190',
            'meta_title' => 'sometimes|nullable|string',
            'meta_description' => 'sometimes|nullable|string',
            'author' => 'sometimes|nullable|exists:users,id',
            'status' => 'required|in:draft,published'
        ];

        if(!array_key_exists('url', $data) || strlen($data['url']) === 0)
        {

            $rules['slug'] = 'required|string|max:190|unique:articles,slug';

        }
        
        $this->validator = Validator::make($data, $rules);
        		
		return !$this->validator->fails();
		
    }

    public function validateCategoryCreate($data)
    {

        $this->validator = Validator::make($data, [
            'title' => 'required|string|min:1|unique:article_categories,title',
            'slug' => 'sometimes|nullable|string'
        ]);		

		return !$this->validator->fails();

    }

    public function validateCategoryUpdate($data)
    {

        $this->validator = Validator::make($data, [
            'title' => 'required|string|min:1',
            'slug' => 'sometimes|nullable|string'
        ]);

		return !$this->validator->fails();

    }

    public function validateUpdate($data)
    {

        $rules = [
            'article_id' => 'required|exists:articles,id',
            'title' => 'required|string|min:1',
            'url' => 'sometimes|nullable|url|max:190',
            'excerpt' => 'required|string|min:1|max:255',
            'content' => 'sometimes|required_without:url',
            'category' => 'required',
            'category.*' => 'integer|exists:article_categories,id',
            'thumbnail' => 'sometimes|file|mimetypes:image/jpeg,image/png|max:5000',
            'tags' => 'sometimes|nullable|string',
            'slug' => 'sometimes|nullable|string|max:190',
            'meta_title' => 'sometimes|nullable|string',
            'meta_description' => 'sometimes|nullable|string',
            'author' => 'sometimes|nullable|exists:users,id',
            'status' => 'required|in:draft,published',
            'created_at' => 'required|date'
        ];

        if(!array_key_exists('url', $data) || strlen($data['url']) === 0)
        {

            $rules['slug'] = 'required|string|max:190|unique:articles,slug,'.$data['article_id'];

        }

        $this->validator = Validator::make($data, $rules);
        		
		return !$this->validator->fails();        

    }

    public function getErrors()
    {
        
        if(!$this->validator) 
        {
            
            return null;

        }

        return $this->validator;

    }
    
}