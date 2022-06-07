<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    private $baseView;
    
    public function __construct()
    {
        $this->baseView = 'customer/wishlist';
    }

    public function index()
    {
        return view($this->baseView . '/index');
    }
}
