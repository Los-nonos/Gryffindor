<?php


namespace Presentation\Http\Validations\Schemas\Products;


use Presentation\Http\Validations\Schemas\PageSizeSchema;

class SearchProductsSchema
{
    public static function getRules(): array {
        return [
          'query' => 'bail|alpha_dash',
          'categories' => 'bail|array',
          'categories.*' => 'bail|integer',
          'brands' => 'bail|array',
          'brands.*' => 'bail|integer',
          'providers' => 'bail|array',
          'providers.*' => 'bail|integer',
          ...PageSizeSchema::getRules(),
          'orderBy' => 'bail|alpha|length:3'
        ];
    }
}
