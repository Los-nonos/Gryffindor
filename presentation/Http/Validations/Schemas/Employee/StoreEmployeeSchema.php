<?php


namespace Presentation\Http\Validations\Schemas\Employee;


class StoreEmployeeSchema
{
    public function getRules(): array {
        return [
            'name' => 'bail|required|alpha|min:3',
            'surname' => 'bail|required|alpha|min:3',
            'username' => 'bail|required|alpha|min:3|max:25',
            'password' => 'bail|required|min:8|max:25',
            'email' => 'bail|required|email',
            'role' => 'bail|required|array'
        ];
    }
}
