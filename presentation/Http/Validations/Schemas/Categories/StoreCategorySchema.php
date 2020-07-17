<?php


namespace Presentation\Http\Validations\Schemas\Categories;


class StoreCategorySchema
{
    public function getRules(): array {
        return [
            'name' => 'bail|required|min:3|max:50',
        ];
    }
}
