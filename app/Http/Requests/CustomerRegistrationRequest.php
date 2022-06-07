<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Auth;

class CustomerRegistrationRequest extends FormRequest
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
            'firstname' => 'required|max:150',
            'lastname' => 'required|max:150',
            'contact_no' => 'nullable',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|required_with:confirm_password|min:6',
            'confirm_password' => 'same:password|min:6',
        ];
    }
}
