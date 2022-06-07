<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerRegistrationRequest;
use App\Models\Role;
use App\Models\User;

class CustomerRegistrationController extends Controller
{
    public function store(CustomerRegistrationRequest $request)
    {
        $user = new User;
        $user->role_id = Role::_CUSTOMER;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->contact_no = $request->contact_no;
        $user->email = $request->email;
        $user->password = $request->password;
        // $user->is_active = false;
        $user->save();

        return response()->json([
            'message' => 'Succesfully registered!',
            'status'  => 'success'
        ]);
    }
}
