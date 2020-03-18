<?php

declare(strict_types=1);

namespace Presentation\Http\Adapters\Users;

use Application\Commands\User\UpdateUserCommand;
use Exception;
use Illuminate\Http\Request;
use Presentation\Exceptions\InvalidBodyException;
use Presentation\Interfaces\ValidatorServiceInterface;

class UpdateUserAdapter
{
    private $rules = [
        'id' => 'bail|required|integer',
        'name' => 'bail|required|alpha',
        'email' => 'bail|required|email',
        'password' => 'bail|required|min:4|max:16'
    ];

    public function getRules(){
        return $this->rules;
    }

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

    public function __construct(
        ValidatorServiceInterface $validator
    ) {
        $this->validator = $validator;
    }

    /**
     * @param Request $request
     * @return UpdateUserCommand
     * @throws Exception
     */
    public function adapt(Request $request)
    {
        $this->validator->make($request->all(),$this->getRules());

        if(!$this->validator->isValid()){
            throw new InvalidBodyException(412, $this->validator->getErrors());
        }

        return new UpdateUserCommand(
            $request->get('id'),
            $request->get('name'),
            $request->get('email'),
            $request->get('password')
        );
    }
}
