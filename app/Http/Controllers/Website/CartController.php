<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CartItem;
use Auth, DB;

class CartController extends Controller
{
    public function addToCart($productID)
    {
        $userID = Auth::user()->id?? 0;

        // check if product already exists in cart
        $existingCartItem = CartItem::whereUserIdAndProductId($userID, $productID)->first();
        if ($existingCartItem) {
            CartItem::whereId($existingCartItem->id)->increment('qty');
        } else {
            CartItem::create([
                'user_id'    => $userID,
                'product_id' => $productID,
                'qty'        => 1
            ]);
        }

        return back()->with('success', 'Product added to cart.');
    }

    public function removeFromCart($id)
    {
        $cartItem = CartItem::find($id);
        if ($cartItem) {
            $cartItem->delete();
        }

        return back()->with('success', 'Product removed from cart.');
    }

    public function emptyCart()
    {
        $userID = Auth::user()->id;
        CartItem::whereUserId($userID)->delete();
        return back()->with('success', 'Cart is now empty.');
    }
}
