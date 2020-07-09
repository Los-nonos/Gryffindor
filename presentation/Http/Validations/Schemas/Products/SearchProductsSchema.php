<?php


namespace Presentation\Http\Validations\Schemas\Products;


use Presentation\Http\Validations\Schemas\PageSizeSchema;

class SearchProductsSchema
{
    public static function getRules(): array {
        return [
          'query' => 'bail|alpha_dash',
          'categories' => 'bail|array',
          'categories.*' => 'bail|integer|min:0',
          'brands' => 'bail|array',
          'brands.*' => 'bail|integer|min:0',
          'providers' => 'bail|array',
          'providers.*' => 'bail|integer|min:0',
          'page' => 'bail|integer|min:0',
          'size' => 'bail|integer|min:0',
          'orderBy' => 'bail|alpha|length:3'
        ];
    }
}
