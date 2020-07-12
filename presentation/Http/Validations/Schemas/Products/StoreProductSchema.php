<?php


namespace Presentation\Http\Validations\Schemas\Products;


class StoreProductSchema
{
    /**
     * @return array|string[]
     */
    public function getRules(): array
    {
        return [
            'name' => 'bail|required|regex:/^[\pL\s]+$/u|min:10|max:256',
            'description' => 'bail|required|min:10|max:2700',
            'price' => 'bail|required|numeric|regex:/^\d*(\.\d{2})?$/|min:0.01',
            'categories' => 'bail|required|array',
            'stock' => 'bail|required|numeric|integer|min:0',
            'iva' => 'bail|required|numeric|min:0',
            'brand' => 'bail|required|min:1|array',
            'characteristics' => 'bail|required|array',
            'order' => 'bail|required|alpha_num',
            'provider' => 'bail|required|array'
        ];
    }

    /**
     * @return array|string[]
     */
    public function getMessages() : array
    {

        return [
            'name.required' => 'Debe ingresar el nombre del producto',
            'name.regex' => 'El nombre del producto solo puede contener números y letras',
            'name.min' => 'El nombre del producto debe tener 10 carácteres como mínimo',
            'name.max' => 'El nombre del producto debe tener 256 carácterés como máximo',
            'description.required'  => 'Debe ingresar la descripción del producto',
            'description.regex'  => 'Revise el formato de la descripcion del producto',
            'description.min' => 'La descripción del producto debe tener 10 carácteres como mínimo',
            'description.max'  => 'La descripción del producto debe tener 2700 carácterés como máximo',
            'price.required' => 'Debe ingresar el precio del producto',
            'price.numeric' => 'El precio del producto debe ser solo números',
            'price.regex' => 'El precio del producto debe ser solo números con 2 decimales',
            'price.min' => 'El precio mínimo permitido de un producto es de $0.01',
            'categories.required' => 'Debe seleccionar al menos una categoría ṕara el producto',
            'stock.required' => 'Debe ingresar el stock del producto',
            'stock.integer' => 'El stock debe ser un número entero',
            'stock.min' => 'El stock mínimo permitido es 0',
            'iva.required' => 'Debe ingresar el porcentaje de IVA del producto',
            'iva.numeric' => 'El IVA ingresado debe ser un número',
            'iva.min' => 'El IVA mínimo permitido es 0%',
            'brand.required' => 'Debe ingresar una marca para el producto',
            'brand.regex' => 'La marca ingresada para el producto contener solo números y letras',
            'brand.min' => 'La marca ingresada debe tener al menos 1 caracter',
            'characteristics.required' => 'Debe ingresar las características del producto',
            'order.alpha_num' => 'La orden ingresada solo debe contener números y letras',
            'order.required' => 'Debe ingresar el número de orden de compra del producto',
            'provider.required' => 'Debe seleccionar el proveedor al que se le ha comprado el producto'
        ];
    }
}
