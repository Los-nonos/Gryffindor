<?php


namespace Presentation\Http\Validations\Schemas\Orders;


class IndexOrdersSchema
{
    public static function getFiltered() {
        return [
            'page' => 'bail|integer|min:1',
            'size' => 'bail|integer',
            'userId' => 'bail|required|integer|min:1'
        ];
    }

    public static function getAll() {
        return [
            'page' => 'bail|integer|min:1',
            'size' => 'bail|integer',
        ];
    }
}
