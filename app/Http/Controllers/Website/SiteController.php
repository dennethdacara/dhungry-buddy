<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Product;
use App\Models\Slider;

class SiteController extends Controller
{
    private $baseView;

    public function __construct()
    {
        $this->baseView = 'website';
    }

    public function home()
    {
        $sliders = Slider::oldest('sort')->get();
        $products = Product::all();

        return view($this->baseView . '/home', compact('sliders', 'products'));
    }

    public function aboutUs()
    {
        $members = Member::oldest('sort')->get();
        return view($this->baseView . '/about_us', compact('members'));
    }
}
