<?php


namespace Application\Queries\Results\Providers;


use Domain\Entities\Provider;
use Infrastructure\QueryBus\Result\ResultInterface;

class FindProviderResult implements ResultInterface
{
    /**
     * @var Provider
     */
    private Provider $provider;

    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * @return Provider
     */
    public function getProvider(): Provider
    {
        return $this->provider;
    }
}
