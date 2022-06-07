<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Auth;

class CategoryRequest extends FormRequest
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
        $categoryID = $this->isMethod('PATCH') ? ',' . $this->request->get('category_id') : '';

        return [
            'name' => 'required|unique:categories,name'.$categoryID,
            'parent_id' => 'nullable',
            'sort' => 'integer|min:1'
        ];
    }
}
