<?php


namespace Presentation\Http\Validations\Schemas\Customers;


class StoreCustomerSchema
{
    public function getRules(): array
    {
        return [
            'name' => 'bail|required|alpha|min:3',
            'surname' => 'bail|required|alpha|min:3',
            'email' => 'bail|required|email',
            'birthday' => 'bail|required|date|date_format:iso',
            'country' => 'bail|required|alpha|min:3|max:40',
            'state' => 'bail|required|alpha|min:3|max:40',
            'city' => 'bail|required|alpha_dash|min:3|max:40',
            'postal_code' => 'bail|required|alpha|min:3|max:10',
            'cell_phone' => 'bail|required|alpha_dash|min:3|max:20',
            'dni' => 'bail|required|number|min:3|max:11',
            'taxation_number' => 'bail|alpha_dash|min:3|max:18',
            'gross_income' => 'bail|alpha|min:3',
        ];
    }
}
