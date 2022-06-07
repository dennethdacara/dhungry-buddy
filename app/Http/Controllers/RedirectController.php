<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\Order;
use Auth;

class RedirectController extends Controller
{
    private $baseCMSView;
    private $baseSiteView;
    
    public function __construct()
    {
        $this->baseCMSView = 'cms';
        $this->baseSiteView = 'website';
    }

    public function index(Request $request)
    {
        $roleID = Auth::user()->role_id;

        if ($roleID == Role::_ADMIN) {
            $totalOrders = Order::count();
            return view($this->baseCMSView . '/dashboard', compact('totalOrders'));
        }

        if ($roleID == Role::_CUSTOMER) {
            $user = Auth::user();
            return view($this->baseSiteView . '/profile', compact('user'));
        }
    }
}
