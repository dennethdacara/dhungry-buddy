<?php

namespace App\Http\Controllers\CMS\ManageOrders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderHistory;
use App\Models\OrderStatus;
use Auth, DB;

class OrderController extends Controller
{
    private $baseView;
    
    public function __construct()
    {
        $this->baseView = 'cms/manage-orders';
    }

    public function index()
    {
        $orders = Order::leftjoin('order_statuses as os', 'os.id', 'orders.order_status_id')
            ->leftjoin('users as u', 'u.id', 'orders.user_id')
            ->latest('orders.created_at')
            ->get(['orders.*', 'os.name as status', 'u.firstname', 'u.lastname']);

        return view($this->baseView . '/index', compact('orders'));
    }

    public function edit($id)
    {
        $order = Order::leftjoin('order_statuses as os', 'os.id', 'orders.order_status_id')
            ->leftjoin('users as u', 'u.id', 'orders.user_id')
            ->where('orders.id', $id)
            ->first(['orders.*', 'os.name as status', 'u.firstname', 'u.lastname', 'u.email', 'u.contact_no']);

        $order->purchased_by = $order->firstname.' '.$order->lastname;
        $orderDetails = OrderDetail::leftjoin('products as p', 'p.id', 'order_details.product_id')
            ->whereOrderId($id)
            ->get(['order_details.*', 'p.title as product_name']);

        $orderHistories = OrderHistory::leftjoin('order_statuses as os', 'os.id', 'order_history.order_status_id')
            ->whereOrderId($id)
            ->get(['order_history.*', 'os.name as status'])
            ->map(function ($data) {
                $data->formatted_created_at = date('m/d/Y h:i:s A', strtotime($data->created_at));
                return $data;
            });

        $existingOrderStatusIDs = OrderHistory::whereOrderId($id)->pluck('order_status_id')->toArray();
        $orderStatuses = OrderStatus::whereNotIn('id', $existingOrderStatusIDs)->get();

        return view($this->baseView . '/edit', compact('order', 'orderDetails', 'orderStatuses', 'orderHistories', 'existingOrderStatusIDs'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->order_status_id = $request->order_status_id;
        $order->remarks = $request->remarks;
        $order->save();

        $orderHistory = new OrderHistory;
        $orderHistory->order_id = $order->id;
        $orderHistory->order_status_id = $request->order_status_id;
        $orderHistory->remarks = $request->remarks;
        $orderHistory->save();

        return back()->with('success', 'Order status has been updated.');
    }
}
