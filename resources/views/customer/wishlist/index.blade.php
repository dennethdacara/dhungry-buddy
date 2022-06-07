@extends('layouts.site_app')

@section('content')

<section class="account-page section-padding">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 mx-auto">
            <div class="row no-gutters">
               <div class="col-md-3">
                  @include('customer/sidebar/index')
               </div>
               <div class="col-md-9">
                  <div class="card card-body account-right">
                     <div class="widget">
                        <div class="section-header">
                           <h5 class="heading-design-h5">
                              Wishlist
                           </h5>
                        </div>

                        <div class="row">
                           <div class="col-md-12">
                              <h6 class="text-muted"><i>No wishlist to display.</i></h6>
                           </div>
                        </div>

                        {{-- <div class="row no-gutters">
                           <div class="col-md-6">
                              <div class="product">
                                 <a href="#">
                                    <div class="product-header">
                                       <span class="badge badge-success">50% OFF</span>
                                       <img alt="" src="img/item/1.jpg" class="img-fluid">
                                       <span class="veg text-success mdi mdi-circle"></span>
                                    </div>
                                    <div class="product-body">
                                       <h5>Product Title Here</h5>
                                       <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
                                    </div>
                                    <div class="product-footer">
                                       <button class="btn btn-secondary btn-sm float-right" type="button"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
                                       <p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i><br><span class="regular-price">$800.99</span></p>
                                    </div>
                                 </a>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="product">
                                 <a href="#">
                                    <div class="product-header">
                                       <span class="badge badge-success">50% OFF</span>
                                       <img alt="" src="img/item/2.jpg" class="img-fluid">
                                       <span class="veg text-success mdi mdi-circle"></span>
                                    </div>
                                    <div class="product-body">
                                       <h5>Product Title Here</h5>
                                       <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
                                    </div>
                                    <div class="product-footer">
                                       <button class="btn btn-secondary btn-sm float-right" type="button"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
                                       <p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i><br><span class="regular-price">$800.99</span></p>
                                    </div>
                                 </a>
                              </div>
                           </div>
                        </div> --}}
                     </div>
                  </div>
               </div>

            </div>
         </div>
      </div>
   </div>
</section>

@stop