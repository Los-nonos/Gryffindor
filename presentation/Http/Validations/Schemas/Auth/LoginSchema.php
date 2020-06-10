<?php


namespace Presentation\Http\Validations\Schemas\Auth;


class LoginSchema
{
    public function getRules():array
    {
        return [
            'username' => 'bail|required|alpha',
            'password' => 'bail|required|min:4|max:16'
        ];
    }
}
