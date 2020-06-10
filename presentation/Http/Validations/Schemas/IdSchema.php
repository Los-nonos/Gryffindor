<?php


namespace Presentation\Http\Validations\Schemas;


class IdSchema
{
    public function getRule():array
    {
        return [
            'id' => 'bail|required|integer|min:0'
        ];
    }
}
