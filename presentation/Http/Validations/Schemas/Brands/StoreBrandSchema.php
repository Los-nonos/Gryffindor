<?php


namespace Presentation\Http\Validations\Schemas\Brands;


class StoreBrandSchema
{
    public static function getRules() {
        return [
            'name' => 'bail|required|alpha|min:3|max:25',
            'description' => 'bail|alpha_dash'
        ];
    }
}
