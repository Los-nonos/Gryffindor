<?php


namespace Presentation\Http\Adapters\Product;


use App\Exceptions\InvalidBodyException;
use Application\Commands\Command\Products\StoreProductCommand;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;
use Presentation\Http\Enums\HttpCodes;
use Presentation\Http\Validations\Schemas\Products\StoreProductSchema;
use Presentation\Http\Validations\Utils\ValidatorServiceInterface;

class StoreProductAdapter
{
    /**
     * @var ValidatorServiceInterface
     */
    private ValidatorServiceInterface $validatorService;

    /**
     * @var StoreProductSchema
     */
    private StoreProductSchema $productSchema;

    /**
     * StoreProductAdapter constructor.
     * @param ValidatorServiceInterface $validatorServiceInterface
     * @param StoreProductSchema $storeProductSchema
     */
    public function __construct
    (
        ValidatorServiceInterface $validatorServiceInterface,
        StoreProductSchema $storeProductSchema
    )
    {
        $this->validatorService = $validatorServiceInterface;
        $this->productSchema = $storeProductSchema;
    }


    /**
     * @param Request $request
     * @return StoreProductCommand
     * @throws InvalidBodyException
     */
    public function adapt(Request $request)
    {
        $this->validatorService->make($request->all(), $this->productSchema->getRules(), $this->productSchema->getMessages());
        if(!$this->validatorService->isValid()){
            throw new InvalidBodyException($this->validatorService->getErrors());
        }

        return new StoreProductCommand(
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
