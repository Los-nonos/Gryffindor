<?php

namespace Presentation\Http\Adapters\Auth;

use Application\Commands\Auth\LoginCommand;
use Illuminate\Http\Request;
use App\Exceptions\InvalidBodyException;
use Exception;
use Presentation\Http\Validations\Schemas\Auth\LoginSchema;
use Presentation\Http\Validations\Utils\ValidatorServiceInterface;

class LoginAdapter
{
    private ValidatorServiceInterface $validator;

    private LoginSchema $loginSchema;

    public function __construct(
        ValidatorServiceInterface $validator,
        LoginSchema $loginSchema
    ) {
        $this->validator = $validator;
    }

    /**
     * @param Request $request
     * @return LoginCommand
     * @throws InvalidBodyException
     */
    public function from(Request $request)
    {
        $this->validator->make($request->all(),$this->loginSchema->getRules());

        if(!$this->validator->isValid()){
            throw new InvalidBodyException($this->validator->getErrors());
        }

        return new LoginCommand(
            $request->get('username'),
            $request->get('password')
        );
    }
}
