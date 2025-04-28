<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Model\Contracts\Interfaces\Data\UserRepositoryInterface;
use Auth;
use App;

class EmailUnique implements Rule
{

    protected $id;

    public function __construct($id = null)
    {
        $this->id = $id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        $userRepository = App::make(UserRepositoryInterface::class);

        try {

            $user = $userRepository->getByEmailCaseInsensitive($value);

            if($this->id)
            {

                if($this->id == $user->id) return true;

            }

            return false;

        }catch(\Exception $e) {

            return true;

        }

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {

        return 'Email already taken';
        
    }
}
