<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Auth;

class MemberRequest extends FormRequest
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
        $memberID = $this->isMethod('PATCH') ? ',' . $this->request->get('member_id') : '';

        return [
            'name' => 'required|unique:members,name'.$memberID,
            'thumbnail' => 'nullable|max:4096|mimes:jpg,jpeg,png,bmp',
            'position' => 'required|max:50',
            'excerpt' => 'nullable|max:100',
            'sort' => 'integer|min:1'
        ];
    }
}
