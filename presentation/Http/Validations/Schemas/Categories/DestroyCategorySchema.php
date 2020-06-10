<?php


namespace Presentation\Http\Validations\Schemas\Categories;


class DestroyCategorySchema
{
    public function getRules(): array {
        return [
          'id' => 'bail|required|integer|min:0',
        ];
    }
}
