<?php


namespace Presentation\Http\Validations\Schemas\Customers;


class UpdateCustomerSchema
{
    public function getRules(): array
    {
        return [
            'vat_condition' => 'bail|required|alpha_dash',
            'birthday' => 'bail|required|date',
            'country' => 'bail|required|alpha|min:3|max:40',
            'state' => 'bail|required|alpha|min:3|max:40',
            'city' => 'bail|required|alpha_dash|min:3|max:40',
            'postal_code' => 'bail|required|alpha_num|min:3|max:10',
            'cell_phone' => 'bail|required|alpha_dash|min:3|max:20',
            'dni' => 'bail|required|alpha_num|min:3|max:11',
            'taxation_number' => 'bail|alpha_dash|min:3|max:18',
            'gross_income' => 'bail|alpha|min:3',
        ];
    }
}
