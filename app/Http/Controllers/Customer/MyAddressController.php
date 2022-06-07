<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MyAddressRequest;
use App\Models\User;
use Auth;

class MyAddressController extends Controller
{
    private $baseView;
    
    public function __construct()
    {
        $this->baseView = 'customer/my-address';
    }

    public function index()
    {
        $user = Auth::user();
        return view($this->baseView . '/index', compact('user'));
    }

    public function store(MyAddressRequest $request)
    {
        $user = Auth::user();
        $user->address_line_1 = $request->address_line_1;
        $user->unit_block_street = $request->unit_block_street;
        $user->zipcode = $request->zipcode;
        $user->save();

        return back()->with('success', 'Contact Address updated successfully');
    }
}
