<?php

namespace Presentation\Http\Adapters\Auth;

use Application\Queries\Query\Auth\LoginQuery;
use Illuminate\Http\Request;
use App\Exceptions\InvalidBodyException;
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
        $this->loginSchema = $loginSchema;
    }

    /**
     * @param Request $request
     * @return LoginQuery
     * @throws InvalidBodyException
     */
    public function from(Request $request)
    {
        $this->validator->make($request->all(),$this->loginSchema->getRules());

        if(!$this->validator->isValid()){
            throw new InvalidBodyException($this->validator->getErrors());
        }

        return new LoginQuery(
            $request->get('username'),
            $request->get('password')
        );
    }
}
