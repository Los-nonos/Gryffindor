<?php


namespace Presentation\Http\Adapters\Users;


use App\Exceptions\InvalidBodyException;
use Application\Commands\Command\Auth\ChangePasswordCommand;
use Application\Services\Token\TokenLoginServiceInterface;
use Illuminate\Http\Request;
use Presentation\Http\Validations\Utils\ValidatorServiceInterface;

class ChangePasswordFromRecoveryAdapter
{
    private ValidatorServiceInterface $validatorService;

    private TokenLoginServiceInterface $tokenLoginService;

    public function __construct(
        ValidatorServiceInterface $validatorService,
        TokenLoginServiceInterface $tokenLoginService
    )
    {
        $this->validatorService = $validatorService;
        $this->tokenLoginService = $tokenLoginService;
    }

    /**
     * @param Request $request
     * @return ChangePasswordCommand
     * @throws InvalidBodyException
     */
    public function from(Request $request)
    {
        $this->validatorService->make($request->all(), []);

        if (!$this->validatorService->isValid())
        {
            throw new InvalidBodyException($this->validatorService->getErrors());
        }

        $hash = $this->tokenLoginService->decryptTokenJWT($request->input('token'));
        $token = $this->tokenLoginService->findOneByHashOrFail($hash);

        return new ChangePasswordCommand(
            $token->getUser()->getEmail(),
            $request->input('password')
        );
    }
}
