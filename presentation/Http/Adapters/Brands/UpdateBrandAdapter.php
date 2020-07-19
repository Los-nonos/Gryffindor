<?php


namespace Presentation\Http\Adapters\Brands;


use App\Exceptions\InvalidBodyException;
use Application\Commands\Command\Brands\UpdateBrandCommand;
use Illuminate\Http\Request;
use Presentation\Http\Validations\Utils\ValidatorServiceInterface;

class UpdateBrandAdapter
{
    private ValidatorServiceInterface $validatorService;

    public function __construct(ValidatorServiceInterface $validatorService)
    {
        $this->validatorService = $validatorService;
    }

    public function from(Request $request) {
        $data = $request->all();
        $data['id'] = $request->route('id');
        $this->validatorService->make($data, []);

        if (!$this->validatorService->isValid()) {
            throw new InvalidBodyException($this->validatorService->getErrors());
        }

        return new UpdateBrandCommand(
            $request->route('id'),
            $request->input('name'),
            $request->input('description')
        );
    }
}
