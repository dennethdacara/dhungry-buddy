<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CheckoutRequest;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderHistory;
use App\Models\OrderStatus;
use App\Models\User;
use Auth, DB;

class CheckoutController extends Controller
{
    private $baseView;

    public function __construct()
    {
        $this->baseView = 'website';
    }

    public function index()
    {
        $user = Auth::user();
        $totalCartItems = 0;
        $subTotal = 0;

        $cartItems = CartItem::leftjoin('products as p', 'p.id', 'cart_items.product_id')
            ->where('cart_items.user_id', Auth::user()->id?? 0)
            ->get(['cart_items.*', 'p.title', 'p.thumbnail', 'p.excerpt', 'p.price'])
            ->map(function ($data) {
                $data->total = number_format($data->price * $data->qty, 2);
                return $data;
            });

        if (count($cartItems) > 0) {
            $totalCartItems = count($cartItems);
            $subTotal = $cartItems->sum('total');
        }

        if (count($cartItems) <= 0) {
            return redirect()->route('redirect');
        }

        $data = [
            'user'           => $user,
            'totalCartItems' => $totalCartItems,
            'subTotal'       => $subTotal,
            'cartItems'      => $cartItems
        ];

        return view($this->baseView . '/checkout', compact('data'));
    }

    public function store(CheckoutRequest $request)
    {
        DB::beginTransaction();

        try {

            $userID = Auth::user()->id;

            // fetch list of cart items and store it in the orders and order_details table 
            $cartItems = CartItem::leftjoin('products as p', 'p.id', 'cart_items.product_id')
                ->where('cart_items.user_id', $userID)
                ->get(['cart_items.*', 'p.price']);

            if (count($cartItems) > 0) {
                $order = new Order;
                $order->user_id = $userID;
                $order->total_amount = $request->subtotal;
                $order->delivery_fee = 0;
                $order->payment_method = $request->payment_method;
                $order->order_status_id = OrderStatus::_PENDING;
                $order->remarks = '';
                $order->unit_block_street = $request->unit_block_street;
                $order->zipcode = $request->zipcode;
                $order->address_line_1 = $request->address_line_1;
                // $order->address_line_2 = $request->address_line_2;
                $order->save();

                foreach ($cartItems as $key => $cartItem) {
                    OrderDetail::create([
                        'order_id'     => $order->id,
                        'product_id'   => $cartItem->product_id,
                        'qty'          => $cartItem->qty,
                        'amount'       => $cartItem->price,
                        'total_amount' => $cartItem->price * $cartItem->qty
                    ]);
                }

                CartItem::whereUserId($userID)->delete();

                $orderHistory = new OrderHistory;
                $orderHistory->order_id = $order->id;
                $orderHistory->order_status_id = OrderStatus::_PENDING;
                $orderHistory->remarks = '';
                $orderHistory->save();
            }

            DB::commit();
            return redirect()->route('checkout.success');
        } catch (\Exception $e) {
            DB::rollback();
            report($e->getMessage());
            // return back()->with('error', 'Something went wrong! Please try again later.');
            return back()->with('error', $e->getMessage());
        }
    }

    public function success()
    {
        return view($this->baseView . '/checkout_success');
    }
}
