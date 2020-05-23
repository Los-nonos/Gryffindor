<?php


namespace Presentation\Http\Adapters\Auth;


use Application\Commands\Auth\RenewTokenCommand;
use Application\Services\Token\TokenLoginServiceInterface;
use Illuminate\Http\Request;
use App\Exceptions\InvalidBodyException;
use Presentation\Http\Validations\Schemas\Auth\RenewTokenSchema;
use Presentation\Http\Validations\Utils\ValidatorServiceInterface;

class RenewTokenAdapter
{
    private ValidatorServiceInterface $validatorService;

    private RenewTokenSchema $schema;

    private TokenLoginServiceInterface $tokenService;

    public function __construct(
        ValidatorServiceInterface $validatorService,
        RenewTokenSchema $schema,
        TokenLoginServiceInterface $tokenService
    )
    {
        $this->validatorService = $validatorService;
        $this->schema = $schema;
        $this->tokenService = $tokenService;
    }

    /**
     * @param Request $request
     * @return RenewTokenCommand
     * @throws InvalidBodyException
     */
    public function from(Request $request)
    {
        $this->validatorService->make($request->all(), $this->schema->getRules());

        if (!$this->validatorService->isValid())
        {
            throw new InvalidBodyException($this->validatorService->getErrors());
        }

        $token = $request->input('token');

        if(!$this->tokenService->exist($token)) {
            throw new InvalidBodyException("Token invalid, not exist");
        }

        return new RenewTokenCommand(
            $token,
        );
    }
}
