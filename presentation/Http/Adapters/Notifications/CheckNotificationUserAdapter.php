<?php


namespace Presentation\Http\Adapters\Notifications;


use App\Exceptions\InvalidBodyException;
use Application\Queries\Query\Notifications\CheckNotificationUserQuery;
use Illuminate\Http\Request;
use Presentation\Http\Validations\Schemas\IdSchema;
use Presentation\Http\Validations\Utils\ValidatorServiceInterface;

class CheckNotificationUserAdapter
{
    private ValidatorServiceInterface $validatorService;

    private IdSchema $idSchema;

    public function __construct(
        ValidatorServiceInterface $validatorService,
        IdSchema $idSchema
    )
    {
        $this->validatorService = $validatorService;
        $this->idSchema = $idSchema;
    }

    public function from(Request $request) {
        $this->validatorService->make($request->all(), $this->idSchema->getRule(), []);

        if (!$this->validatorService->isValid()) {
            throw new InvalidBodyException($this->validatorService->getErrors());
        }

        return new CheckNotificationUserQuery(
            $request->input('id')
        );
    }
}
