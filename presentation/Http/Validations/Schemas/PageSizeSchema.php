<?php


namespace Presentation\Http\Validations\Schemas;


class PageSizeSchema
{
    public static function getRules() {
        return [
            'page' => 'bail|integer|min:1',
            'size' => 'bail|integer',
        ];
    }
}
