<?php


namespace Presentation\Http\Validations\Schemas\Auth;


class RenewTokenSchema
{
    public function getRules():array
    {
        return [
            'token' => 'bail|required|min:3'
        ];
    }
}
