<?php


namespace Presentation\Http\Validations\Schemas\Customers;


class StoreWebCustomerSchema
{

    public function getRules()
    {
        return [
          'name' => 'bail|required|alpha|min:3',
          'surname' => 'bail|required|alpha|min:3',
          'username' => 'bail|required|alpha|min:3|max:25',
          'password' => 'bail|required|min:3|max:25',
          'email' => 'bail|required|email',
        ];
    }
}
