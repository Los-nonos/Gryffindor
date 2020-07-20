<?php


namespace Application\Queries\Results\Providers;


use Domain\Entities\Provider;
use Infrastructure\QueryBus\Result\ResultInterface;

class IndexProvidersResult implements ResultInterface
{
    /**
     * @var Provider[]
     */
    private array $providers;

    /**
     * IndexProvidersResult constructor.
     * @param Provider[] $providers
     */
    public function __construct($providers)
    {
        $this->providers = $providers;
    }

    /**
     * @return Provider[]
     */
    public function getProviders(): array
    {
        return $this->providers;
    }
}
