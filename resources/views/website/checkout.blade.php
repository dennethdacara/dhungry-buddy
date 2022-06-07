@extends('layouts.site_app')

@section('content')

<section class="checkout-page section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="checkout-step">
                    <div class="accordion" id="accordionExample">
                        <div class="card checkout-step-one">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <span class="number">1</span> Checkout Form
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    <form method="POST" action="{{ route('checkout.store') }}">
                                        <input type="hidden" name="subtotal" value="{{ $data['subTotal'] }}" />
                                        @csrf

                                        <div class="heading-part">
                                            <h3 class="sub-heading">Delivery Address</h3>
                                        </div>
                                        
                                        <hr />

                                        @include('customer/partials/message')
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">First Name <span class="required">*</span></label>
                                                    <input 
                                                        type="text" 
                                                        class="form-control border-form-control" 
                                                        name="firstname" 
                                                        value="{{ $data['user']->firstname }}" 
                                                        placeholder="Enter Firstname"
                                                        readonly
                                                    />
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">Last Name <span class="required">*</span></label>
                                                    <input 
                                                        type="text" 
                                                        class="form-control border-form-control" 
                                                        name="lastname" 
                                                        value="{{ $data['user']->lastname }}" 
                                                        placeholder="Enter Lastname"
                                                        readonly
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">Phone <span class="required">*</span></label>
                                                    <input 
                                                        type="text" 
                                                        class="form-control border-form-control" 
                                                        name="contact_no" 
                                                        value="{{ $data['user']->contact_no }}" 
                                                        placeholder="Enter Contact No."
                                                        readonly
                                                    />
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">Email Address <span class="required">*</span></label>
                                                    <input 
                                                        type="email" 
                                                        class="form-control border-form-control" 
                                                        name="email" 
                                                        value="{{ $data['user']->email }}" 
                                                        placeholder="Enter Email Address"
                                                        readonly
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="control-label">Address Line 1 <span class="required">*</span></label>
                                                    <textarea 
                                                        class="form-control border-form-control" 
                                                        name="address_line_1"
                                                        placeholder=""
                                                    >{{ $data['user']->address_line_1 }}</textarea>
                                                    <small>*City/Barangay/Landmark Ex:(Quezon City / Brgy 123 / Across SM)</small>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">House/Unit/Flr #, Bldg Name, Blk or Lot # <span class="required">*</span></label>
                                                    <input 
                                                        class="form-control border-form-control" 
                                                        type="text" 
                                                        name="unit_block_street" 
                                                        value="{{ $data['user']->unit_block_street }}" 
                                                        placeholder=""
                                                    />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Zip Code <span class="required">*</span></label>
                                                    <input 
                                                        class="form-control border-form-control" 
                                                        type="text" 
                                                        name="zipcode" 
                                                        value="{{ $data['user']->zipcode }}" 
                                                        placeholder="Enter Zipcode" 
                                                    />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Payment Method <span class="required">*</span></label>
                                                    <select class="form-control border-form-control" name="payment_method">
                                                        <option value="Cash on Delivery">Cash on Delivery (COD)</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 text-right">
                                                <h5>Total Amount: ₱{{ $data['subTotal'] }}</h5>
                                                <p>To be paid via <i>Cash on Delivery</i></p>
                                            </div>
                                        </div>

                                        <hr />

                                        <div class="row">
                                            <div class="col-sm-12 text-right">
                                                <button type="submit" class="btn btn-secondary mb-2 btn-lg" onclick="return confirm('Place Order?')">Place Order</button>
                                            </div>
                                        </div>
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <h5 class="card-header">
                        My Cart <span class="text-secondary float-right">({{ $data['totalCartItems']?? 0 }} item/s)</span>
                    </h5>
                    <div class="card-body pt-0 pr-0 pl-0 pb-0">
                        @foreach($data['cartItems'] as $cartItem)
                            <div class="cart-list-product">
                                <a
                                    class="float-right remove-cart" 
                                    href="{{ route('cart.remove_from_cart', ['cart_item_id' => $cartItem->id]) }}"
                                    onclick="return confirm('Remove item from cart?')">
                                    <i class="mdi mdi-close"></i>
                                </a>
                                <img class="img-fluid" src="{{ asset('uploads/products/' . $cartItem->thumbnail)}}" alt="{{ $cartItem->title }}">
                                <h5><a href="#">{{ $cartItem->title }} x{{ $cartItem->qty }}</a></h5>
                                <h6>Base Price: ₱{{ $cartItem->price }}</h6>
                                <h6>{{ $cartItem->excerpt }}</h6>
                                <p class="offer-price mb-0">₱{{ $cartItem->price * $cartItem->qty }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@stop