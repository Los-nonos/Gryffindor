<?php


namespace Presentation\Http\Validations\Schemas\Providers;


class StoreProviderSchema
{
    public static function getRules(): array {
        return [
            'name' => 'bail|required|min:3|max:25',
            'businessName' => 'bail|required|min:3|max:25',
            'phoneNumber' => 'bail|min:9|max:25',
            'zipCode' => 'bail|max:6',
            'address' => 'bail|max:25',
            'observations' => 'bail|max:255',
        ];
    }
}
