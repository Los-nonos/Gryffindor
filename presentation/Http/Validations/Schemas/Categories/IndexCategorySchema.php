<?php


namespace Presentation\Http\Validations\Schemas\Categories;


class IndexCategorySchema
{
    public function getRules(): array {
        return [
            'page' => 'bail|integer',
            'size' => 'bail|integer'
        ];
    }
}
