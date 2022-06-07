@extends('layouts.site_app')

@section('content')

<!-- carousel / slider -->
<section class="carousel-slider-main text-center border-top border-bottom bg-white">
   <div class="owl-carousel owl-carousel-slider">
      @foreach($sliders as $slider)
         <div class="item">
            <a href="#!">
               <img 
                  class="img-fluid" 
                  src="{{ $slider->thumbnail ? asset('uploads/sliders/'.$slider->thumbnail) : '' }}" 
                  alt="{{ $slider->title }}" 
               />
            </a>
         </div>
      @endforeach
   </div>
</section>
<!-- / -->

<!-- our menu -->
<section class="product-items-slider section-padding">
   <div class="container">
      <div class="section-header">
         <h5 class="heading-design-h5">OUR MENU
            <a class="float-right text-secondary" href="#!">View All</a>
         </h5>
      </div>
      <div class="owl-carousel owl-carousel-featured">
         @foreach($products as $product)
            <div class="item">
               <div class="product">
                  <a href="#!">
                     <div class="product-header">
                        <img 
                           class="img-fluid" 
                           src="{{ $product->thumbnail ? asset('uploads/products/'.$product->thumbnail) : '' }}" 
                           alt="{{ $product->title }}" 
                        />
                     </div>
                     <div class="product-body">
                        <h5>{{ $product->title }}</h5>
                        <h6>{{ $product->excerpt }}</h6>
                     </div>
                     <div class="product-footer">
                        @if(Auth::check())
                           <a href="{{ route('cart.add_to_cart', ['product_id' => $product->id ]) }}" 
                              class="btn btn-secondary btn-sm float-right">
                              <i class="mdi mdi-cart-outline"></i> 
                              Add To Cart
                           </a>
                        @endif
                        <p class="offer-price pt-1 mb-0">₱{{ $product->price }} <i class="mdi mdi-tag-outline"></i></p>
                     </div>
                  </a>
               </div>
            </div>
         @endforeach
      </div>
    </div>
</section>
<!-- / -->

<!-- banner -->
<section class="section-padding bg-white border-top">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-sm-6">
                <div class="feature-box">
                    <i class="mdi mdi-truck-fast"></i>
                    <h6>Free Delivery</h6>
                    <p>Lorem ipsum dolor sit amet, cons...</p>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="feature-box">
                    <i class="mdi mdi-basket"></i>
                    <h6>Easy Payments</h6>
                    <p>Rorem Ipsum Dolor sit amet, cons...</p>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="feature-box">
                    <i class="mdi mdi-tag-heart"></i>
                    <h6>24/7 Service</h6>
                    <p>Sorem Ipsum Dolor sit amet, Cons...</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- / -->

@stop