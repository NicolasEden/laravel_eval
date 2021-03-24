<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DishesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'data' => [
                'libelle' => ["required", "string"],
                'price' => ['required', 'numeric'],
                'weight' => ['required', 'numeric'],
                'dishes_origines' => ['required', 'numeric'],
                'dishes_types' => ['required', 'numeric'],
                'dishes_type_food' => ['required', 'numeric'],
                'ingredients' => ['']
            ]
        ];
    }
}
