<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Auth;

class SliderRequest extends FormRequest
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
        $sliderID = $this->isMethod('PATCH') ? ',' . $this->request->get('slider_id') : '';

        return [
            'title' => 'required|unique:sliders,title'.$sliderID,
            'thumbnail' => 'nullable|max:4096|mimes:jpg,jpeg,png,bmp',
            'sort' => 'integer|min:1'
        ];
    }
}
