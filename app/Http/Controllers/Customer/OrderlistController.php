<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Auth;

class OrderlistController extends Controller
{
    private $baseView;
    
    public function __construct()
    {
        $this->baseView = 'customer/orderlist';
    }

    public function index()
    {
        $userID = Auth::user()->id;
        $orders = Order::leftjoin('order_statuses as os', 'os.id', 'orders.order_status_id')
            ->where('user_id', $userID)
            ->latest('orders.created_at')
            ->get(['orders.*', 'os.name as status'])
            ->map(function ($data) {
                $data->formatted_created_at = date('M d, Y', strtotime($data->created_at));
                return $data;
            });

        return view($this->baseView . '/index', compact('orders'));
    }
}
