<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Auth;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $productID = $this->isMethod('PATCH') ? ',' . $this->request->get('product_id') : '';

        return [
            'title' => 'required|unique:products,title'.$productID,
            'thumbnail' => 'nullable|max:4096|mimes:jpg,jpeg,png,bmp',
            'excerpt' => 'nullable|max:150',
            'description' => 'nullable|max:255',
            'price' => 'required|numeric|between:0,99999.99',
            'type' => 'nullable',
            'sort' => 'integer|min:1'
        ];
    }
}
