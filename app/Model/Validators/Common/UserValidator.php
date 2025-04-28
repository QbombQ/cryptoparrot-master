<?php 

namespace App\Model\Validators\Common;

use App\Model\Contracts\Interfaces\Validators\Common\UserValidatorInterface;
use App\Model\Data\Models\Patron;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Rules\ValidSocialNetwork;
use App\Rules\ValidNotification;
use App\Rules\ValidOldPassword;
use App\Rules\HandleUnique;
use App\Rules\EmailUnique;
use App\Rules\EmailRequired;

class UserValidator implements UserValidatorInterface
{

    protected $validator;
    protected $countryValidator;

    private function slugify($username) 
    {
        return preg_replace("/[^A-Za-z0-9]/","",$username);
    }    

    public function validateCurrentPortfolioChange($data)
    {

        $this->validator = Validator::make($data, [
            'portfolio_id' => 'required|exists:portfolios,id'
        ]);		   

		return !$this->validator->fails();

    }
	
	public function validateCreation($data)
	{

        $method = $data['method'];
		$this->validator = Validator::make($data, [
            'username' => 'nullable|unique:users,username|min:3|max:20',
            'email' => [new EmailRequired($method), 'email', 'unique:users,email'],
            'password' => 'nullable|required_if:method,email|min:8',
            'method' => 'required|in:email,twitter,facebook,google,reddit,steemit,discord',
            'key' => 'required_unless:method,email'
        ], [
            'required_if' => 'The :attribute field is required.',
            'required_unless' => 'The :attribute field is required.'
        ]);		

        if($this->validator->fails())
        {

            return false;

        }

        if(array_key_exists('username', $data))
        {

            $data2['handle'] = $this->slugify($data['username']);
            $this->validator = Validator::make($data2, [
                'handle' => ['required','unique:users,handle',new HandleUnique()]
            ], [
                'unique' => 'Username already taken'
            ]);

        } 

        if($this->validator->fails())
        {

            return false;

        }

        if(array_key_exists('email', $data))
        {

            $data3['email'] = $data['email'];
            $this->validator = Validator::make($data3, [
                'email' => ['required','unique:users,email',new EmailUnique()]
            ], [
                'unique' => 'Email already taken'
            ]);

        }

        return !$this->validator->fails();
        
    }

	public function validateReservation($id, $data)
	{
		
		$this->validator = Validator::make($data, [
            'username' => [
                'required',
                'max:20',
                'min:3', 
                Rule::unique('users')->ignore($id)
            ],
            'email' => [
                'sometimes',
                'required',
                'email',
                Rule::unique('users')->ignore($id)
            ]
        ]);		 

        if($this->validator->fails())
        {

            return false;

        }

        if(array_key_exists('username', $data))
        {

            $data2['handle'] = $this->slugify($data['username']);
            $this->validator = Validator::make($data2, [
                'handle' => ['required','unique:users,handle',new HandleUnique()]
            ], [
                'unique' => 'Username already taken'
            ]);

        } 

        if($this->validator->fails())
        {

            return false;

        }

        if(array_key_exists('email', $data))
        {

            $data3['email'] = $data['email'];
            $this->validator = Validator::make($data3, [
                'email' => ['required','unique:users,email',new EmailUnique()]
            ], [
                'unique' => 'Email already taken'
            ]);

        }

        return !$this->validator->fails();
		
    }    

	public function validateProfileUpdate($id, $data)
	{
		
		$this->validator = Validator::make($data, [
            'username' => [
                'required',
                'min:3', 
                'max:20',   
                Rule::unique('users')->ignore($id)
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($id)
            ],
            'location' => [
                'nullable'
            ],
            'description' => [
                'nullable',
                'max:160'
            ],
            'notifications' => [
                'sometimes',
                'array',
                new ValidNotification
            ]
        ]);		

        if($this->validator->fails())
        {

            return false;

        }

        if(array_key_exists('username', $data))
        {

            $data2['handle'] = $this->slugify($data['username']);
            $this->validator = Validator::make($data2, [
                'handle' => ['required','unique:users,handle,'.$id]
            ], [
                'unique' => 'Username already taken'
            ]);

        } 

        if($this->validator->fails())
        {

            return false;

        }

        if(array_key_exists('email', $data))
        {

            $data3['email'] = $data['email'];
            $this->validator = Validator::make($data3, [
                'email' => ['required','unique:users,email,'.$id]
            ], [
                'unique' => 'Email already taken'
            ]);

        }

        return !$this->validator->fails();   
		
    }     
    
	public function validateSocialLinksUpdate($data)
	{
		
		$this->validator = Validator::make($data, [
            'social' => [
                'required',
                'array',
                new ValidSocialNetwork
            ],
            'social.facebook' => [
                'url',
                'nullable'
            ],
            'social.twitter' => [
                'url',
                'nullable'
            ]
        ],  
        [
            'social.facebook.url' => 'Facebook field must be a full link including https.',                      
            'social.twitter.url' => 'Twitter field must be a full link including https.',                      
        ]);		   

		return !$this->validator->fails();
		
    }     
    
	public function validateNotificationsUpdate($data)
	{
		
		$this->validator = Validator::make($data, [
            'notifications' => [
                'sometimes',
                'array',
                new ValidNotification
            ]
        ]);		

		return !$this->validator->fails();
		
    }      

    public function validateAvatarUpdate($data)
    {

		$this->validator = Validator::make($data, [
            'file' => 'required|file|mimetypes:image/jpeg,image/png|max:1000'
        ]);		
        
		return !$this->validator->fails();

    }

    public function validateCoverUpdate($data)
    {

		$this->validator = Validator::make($data, [
            'file' => 'required|file|mimetypes:image/jpeg,image/png|max:5000'
        ]);
        
		return !$this->validator->fails();

    }

	public function validatePasswordUpdate($data, $oldPasswordHashed)
	{
		
		$this->validator = Validator::make($data, [
            'old_password' => [
                'required',
                new ValidOldPassword($oldPasswordHashed)
            ],
            'new_password' => 'required|confirmed|min:8',
            'new_password_confirmation' => 'required'
        ]);		

		return !$this->validator->fails();
		
    }   
    
	public function validatePasswordChange($data)
	{
		
		$this->validator = Validator::make($data, [
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required',
            'token' => 'required|exists:password_recovery_confirmations,token'
        ]);		

		return !$this->validator->fails();
		
    }        

	public function validateLogin($data)
	{
		
		$this->validator = Validator::make($data, [
            'email' => [
                'required',
                'email',
                'exists:users,email'
            ],
            'password' => [
                'required'
            ]
        ], [
            'exists' => trans('FrontSubsystem/error-messages.email-does-not-exist')
        ]);		

		return !$this->validator->fails();
		
    }       

	public function validateRecover($data)
	{
		
		$this->validator = Validator::make($data, [
            'email' => [
                'required',
                'email',
                'exists:users,email'
            ]
        ], [
            'exists' => trans('FrontSubsystem/error-messages.email-does-not-exist')
        ]);		

		return !$this->validator->fails();
		
    }        

    public function getErrors()
    {
        
        if($this->countryValidator !== null)
        {

            return $this->countryValidator->getValidator();
            
        }

        return $this->validator;

    }
    
}