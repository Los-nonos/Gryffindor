<?php

namespace Presentation\Http\Adapters\Auth;

use Application\Commands\Auth\LoginCommand;
use Illuminate\Http\Request;
use Presentation\Exceptions\InvalidBodyException;
use Exception;
use Presentation\Interfaces\ValidatorServiceInterface;

class LoginAdapter
{
    private ValidatorServiceInterface $validator;

    private $messages = [
        'id.required' => 'The id is required',
        'id.integer' => 'The id must be an integer',
        'name.required' => 'The name is required',
        'name.alpha' => 'The name cannot contain numbers or symbols',
        'email.required' => 'The email is required',
        'email.email' => 'The email is not correct',
        'password.required' => 'The password is required',
        'password.min' => 'The password is too short',
        'password.max' => 'The password is too long'
    ];

    private $rules = [
        'id' => 'bail|required|integer',
        'name' => 'bail|required|alpha',
        'email' => 'bail|required|email',
        'password' => 'bail|required|min:4|max:16'
    ];

    public function __construct(
        ValidatorServiceInterface $validator
    ) {
        $this->validator = $validator;
    }

    /**
     * @param Request $request
     * @return LoginCommand
     * @throws Exception
     */
    public function adapt(Request $request)
    {
        $this->validator->make($request->all(),$this->getRules());

        if(!$this->validator->isValid()){
            throw new InvalidBodyException($this->validator->getErrors());
        }

        return new LoginCommand(
            $request->get('username'),
            $request->get('password')
        );
    }

    private function getRules(){
        return $this->rules;
    }
}
