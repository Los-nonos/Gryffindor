<?php


namespace Presentation\Http\Validations\Schemas\Users;


class RecoveryPasswordSchema
{
    public function getRules(): array {
        return [
            'email' => 'bail|required|email'
        ];
    }
}
