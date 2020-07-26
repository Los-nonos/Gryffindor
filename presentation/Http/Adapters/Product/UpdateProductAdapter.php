<?php


namespace Presentation\Http\Adapters\Product;


use App\Exceptions\InvalidBodyException;
use Application\Commands\Command\Products\UpdateProductCommand;
use Illuminate\Http\Request;
use Presentation\Http\Validations\Schemas\Products\StoreProductSchema;
use Presentation\Http\Validations\Utils\ValidatorServiceInterface;

class UpdateProductAdapter
{
    private ValidatorServiceInterface $validatorService;

    private StoreProductSchema $schema;

    public function __construct(
        ValidatorServiceInterface $validatorService,
        StoreProductSchema $schema
    )
    {
        $this->validatorService = $validatorService;
        $this->schema = $schema;
    }

    public function from(Request $request) {
        $this->validatorService->make($request->all(), $this->schema->getRules());

        if(!$this->validatorService->isValid()) {
            throw new InvalidBodyException($this->validatorService->getErrors());
        }

        return new UpdateProductCommand(
            $request->route('id'),
            $request->input( 'name'),
            $request->input('description'),
            $request->input('images'),
            $request->input('price'),
            $request->input('categories'),
            $request->input('stock'),
            $request->input('taxes'),
            $request->input('brands'),
            $request->input('characteristics'),
            $request->input('purchaseOrderNumber'),
            $request->input('providerId')
        );
    }
}
