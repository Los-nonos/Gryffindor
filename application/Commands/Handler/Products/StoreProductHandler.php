<?php


namespace Application\Commands\Handler\Products;


use Application\Commands\Command\Products\StoreProductCommand;
use Application\Exceptions\StockInvalidQuantity;
use Application\Services\Category\CategoryServiceInterface;
use Domain\Entities\Characteristic;
use Domain\Entities\Filter;
use Domain\Entities\FilterOption;
use Domain\Entities\Order;
use Domain\Entities\Product;
use Domain\Entities\Provider;
use Domain\Entities\PurchaseOrder;
use Domain\Entities\Stock;
use Domain\Interfaces\Services\Brands\BrandServiceInterface;
use Domain\Interfaces\Services\Products\ProductServiceInterface;
use Domain\Interfaces\Services\Provider\ProviderServiceInterface;
use Infrastructure\CommandBus\Handler\HandlerInterface;

class StoreProductHandler implements HandlerInterface
{
    private ProductServiceInterface $productService;

    private BrandServiceInterface $brandService;

    private ProviderServiceInterface $providerService;

    private CategoryServiceInterface $categoryService;

    public function __construct
    (
        ProductServiceInterface $productServiceInterface,
        BrandServiceInterface $brandService,
        ProviderServiceInterface $providerService,
        CategoryServiceInterface $categoryService
    )
    {
        $this->productService = $productServiceInterface;
        $this->brandService = $brandService;
        $this->providerService = $providerService;
        $this->categoryService = $categoryService;
    }

    /**
     * @param StoreProductCommand $command
     * @throws StockInvalidQuantity
     */
    public function handle($command) : void
    {
        $product = new Product();
        $product->setTitle($command->getName());
        $product->setDescription($command->getDescription());
        $product->setPrice($command->getPrice());
        $stock = new Stock();
        $stock->setQuantity($command->getStock());
        $stock->setRemanentQuantity($command->getStock());
        $product->setStock($stock);
        $product->setTaxes($command->getTaxes());

        $brand = $this->brandService->findOneByIdOrFail($command->getBrands()[0]);

        $product->setBrand($brand);
        $purchase = new PurchaseOrder();
        $purchase->setPurchaseNumber($command->getPurchaseNumber());
        $purchase->setAmount($command->getPrice());
        $product->setPurchaseOrder([$purchase]);
        $provider = $this->providerService->findOneByIdOrFail($command->getProviderId());
        $provider->setName($command->getProviderId());
        $product->setProvider($provider);

        $category = $this->categoryService->findOneByIdOrFail($command->getCategories()[0]);

        $product->addCategories($category);

        $characteristics = $command->getCharacteristics();

        $images = $command->getImages();

        foreach ($characteristics as $characteristic) {
            $characteristicObject = new Characteristic();
            $characteristicObject->setName($characteristic['name']);
            $characteristicObject->setProperty($characteristic['value']);
            $characteristicObject->setProduct($product);

            $product->addCharacteristics($characteristicObject);
        }

        foreach ($images as $image) {
            $imageObject = new Characteristic();
            $imageObject->setName('image');
            $imageObject->setProperty($image);
            $imageObject->setProduct($product);

            $product->addCharacteristics($imageObject);
        }

        $this->productService->persist($product);
    }
}
