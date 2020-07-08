<?php


namespace Presentation\Http\Adapters\Auth;


use App\Exceptions\InvalidBodyException;
use Illuminate\Http\Request;
use Presentation\Http\Validations\Utils\ValidatorServiceInterface;

class ChangePasswordAdapter
{
    private ValidatorServiceInterface $validatorService;

    public function __construct(ValidatorServiceInterface $validatorService)
    {
        $this->validatorService = $validatorService;
    }

    public function from(Request $request) {
        $this->validatorService->make($request->all(), []);

        if (!$this->validatorService->isValid()) {
            throw new InvalidBodyException($this->validatorService->getErrors());
        }

        return new ChangePasswordCommand(
          $request->input('id'),
          $request->input('oldPassword'),
          $request->input('newPassword'),
        );
    }
}
