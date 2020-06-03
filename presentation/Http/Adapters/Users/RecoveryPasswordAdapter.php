<?php


namespace Presentation\Http\Adapters\Users;


use App\Exceptions\InvalidBodyException;
use Application\Commands\Command\Users\RecoveryPasswordCommand;
use Application\Exceptions\EntityNotFoundException;
use Application\Services\Users\UserServiceInterface;
use Illuminate\Http\Request;
use Presentation\Http\Validations\Schemas\Users\RecoveryPasswordSchema;
use Presentation\Http\Validations\Utils\ValidatorServiceInterface;

class RecoveryPasswordAdapter
{
    private ValidatorServiceInterface $validatorService;

    private UserServiceInterface $userService;

    private RecoveryPasswordSchema $schema;

    public function __construct(
        ValidatorServiceInterface $validatorService,
        UserServiceInterface $userService,
        RecoveryPasswordSchema $schema
    )
    {
        $this->validatorService = $validatorService;
        $this->userService = $userService;
        $this->schema = $schema;
    }

    /**
     * @param Request $request
     * @return RecoveryPasswordCommand
     * @throws EntityNotFoundException
     * @throws InvalidBodyException
     */
    public function from(Request $request)
    {
        $this->validatorService->make($request->all(), $this->schema->getRules());

        //lack implement google recaptcha

        if(!$this->validatorService->isValid())
        {
            throw new InvalidBodyException($this->validatorService->getErrors());
        }

        $email = $request->input('email');

        if(!$this->userService->existWithEmail($email))
        {
            throw new EntityNotFoundException("Email not found");
        }

        return new RecoveryPasswordCommand(
            $email
        );
    }
}
