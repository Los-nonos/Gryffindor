<?php


namespace Presentation\Http\Validations\Schemas\Categories;


class UpdateCategorySchema
{
    public function getRules(): array {
        return [
            'name' => 'bail|required|min:3|max:50',
            'filters' => 'bail|required|array',
            'filters.*.name' => 'bail|required|alpha',
            'filters.*.options' => 'bail|required|array',
            'filters.*.options.*' => 'bail|required|string'
        ];
    }
}
