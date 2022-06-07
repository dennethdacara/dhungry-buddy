<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class CustomerProfileRequest extends FormRequest
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
        $userID = $this->isMethod('PATCH') ? ',' . $this->request->get('user_id') : '';

        return [
            'firstname' => 'required|max:150',
            'lastname' => 'required|max:150',
            'contact_no' => 'nullable',
            // 'email' => 'required|email|unique:users,email'.$userID,
            'new_password' => 'nullable|min:6',
            'confirm_password' => 'nullable|same:new_password|min:6',
        ];
    }
}
