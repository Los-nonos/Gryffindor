<?php


namespace Presentation\Http\Presenters\Providers;


use Application\Queries\Results\Providers\FindProviderResult;

class FindProviderPresenter
{
    private FindProviderResult $result;

    public function fromResult($result): FindProviderPresenter
    {
        $this->result = $result;
        return $this;
    }

    public function getData(): array {
        $provider = $this->result->getProvider();
        return [
            'id' => $provider->getId(),
            'name' => $provider->getName(),
            'businessName' => $provider->getBusinessName(),
            'address' => $provider->getAddress(),
            'zipCode' => $provider->getZipCode(),
            'phoneNumber' => $provider->getPhoneNumber(),
            'observations' => $provider->getObservations(),
        ];
    }
}
