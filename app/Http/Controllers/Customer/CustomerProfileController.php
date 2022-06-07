<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerProfileRequest;
use App\Models\User;
use Auth, Hash;

class CustomerProfileController extends Controller
{
    public function store(CustomerProfileRequest $request)
    {

        if ($request->old_password) {
            if (!Hash::check($request->old_password, Auth::user()->password)) {
                return back()->with('error', 'Your old password is incorrect');
            }
        }

        if ($request->new_password && !$request->old_password) {
            return back()->with('error', 'Please enter your old password.');
        }

        if ($request->old_password && !$request->new_password) {
            return back()->with('error', 'Please enter and confirm your new password.');
        }

        $user = Auth::user();
        if ($request->old_password) {
            if (Hash::check($request->old_password, Auth::user()->password) && $request->new_password) {
                $user->password = $request->new_password;
            } else {
                return back()->with('error', 'Incorrect password.');
            }
        }

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->contact_no = $request->contact_no;
        $user->save();
        
        return back()->with('success', 'Profile updated successfully');
    }
}
