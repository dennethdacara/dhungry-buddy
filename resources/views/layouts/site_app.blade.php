<?php
   $totalCartItems = 0;
   $subTotal = 0;

   $cartItems = \App\Models\CartItem::leftjoin('products as p', 'p.id', 'cart_items.product_id')
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
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>D'Hungry Buddy - Home</title>
        <!-- Favicon Icon -->
        <link rel="icon" type="image/png" href="{{ asset('site-template/img/favicon.ico') }}">
        <!-- Bootstrap core CSS -->
        <link href="{{ asset('site-template/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <!-- Material Design Icons -->
        <link href="{{ asset('site-template/vendor/icons/css/materialdesignicons.min.css') }}" media="all" rel="stylesheet" type="text/css" />
        <!-- Select2 CSS -->
        <link href="{{ asset('site-template/vendor/select2/css/select2-bootstrap.css') }}" />
        <link href="{{ asset('site-template/vendor/select2/css/select2.min.css') }}" rel="stylesheet" />
        <!-- Custom styles for this template -->
        <link href="{{ asset('site-template/css/osahan.css') }}" rel="stylesheet">
        <!-- Owl Carousel -->
        <link rel="stylesheet" href="{{ asset('site-template/vendor/owl-carousel/owl.carousel.css') }}">
        <link rel="stylesheet" href="{{ asset('site-template/vendor/owl-carousel/owl.theme.css') }}">
    </head>
    <body>

      <!-- login/register modal -->
      <div class="modal fade login-modal-main" id="bd-example-modal" data-backdrop="static" data-keyboard="true">
         <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-body">
                  <div class="login-modal">
                     <div class="row">
                        <div class="col-lg-12 pad-left-0">
                           <button type="button" class="close close-top-right" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true"><i class="mdi mdi-close"></i></span>
                              <span class="sr-only">Close</span>
                           </button>
                           <div class="login-modal-right">
                              <!-- Tab panes -->
                              <div class="tab-content">
                                 <div class="tab-pane active" id="login" role="tabpanel">
                                    <form id="loginModalForm">
                                       @csrf
                                       <h5 class="heading-design-h5">Login to your account</h5>
                                       <div id="loginAlertMsg"></div>
                                       <fieldset class="form-group">
                                          <label>Email Address</label>
                                          <input type="email" name="login_email" id="login_email" class="form-control" placeholder="Enter Email Address">
                                       </fieldset>
                                       <fieldset class="form-group">
                                          <label>Password</label>
                                          <input type="password" name="login_password" id="login_password" class="form-control" placeholder="********">
                                       </fieldset>
                                       <fieldset class="form-group">
                                          <button type="submit" class="btn btn-lg btn-secondary btn-block">Enter to your account</button>
                                       </fieldset>
                                       <div class="custom-control custom-checkbox">
                                          <input type="checkbox" class="custom-control-input" id="customCheck1">
                                          <label class="custom-control-label" for="customCheck1">Remember me</label>
                                       </div>
                                    </form>
                                 </div>
                                 <div class="tab-pane" id="register" role="tabpanel">
                                    <form id="registerModalForm">
                                       @csrf
                                       <h5 class="heading-design-h5">Register Now!</h5>
                                       <div id="registerAlertMsg"></div>

                                       <div class="alert alert-danger" id="validationErrorDiv" style="display: none;" role="alert">
                                          <ul id="errorUL" style="list-style-type: none;"></ul>
                                       </div>

                                       <div class="row">
                                          <div class="col-md-6">
                                             <fieldset class="form-group">
                                                <label>Firstname</label>
                                                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Enter Firstname">
                                             </fieldset>
                                          </div>
                                          <div class="col-md-6">
                                             <fieldset class="form-group">
                                                <label>Lastname</label>
                                                <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Enter Lastname">
                                             </fieldset>
                                          </div>
                                       </div>

                                       <div class="row">
                                          <div class="col-md-12">
                                             <fieldset class="form-group">
                                                <label>Contact No</label>
                                                <input type="text" class="form-control" name="contact_no" id="contact_no" placeholder="Enter Contact No">
                                             </fieldset>
                                          </div>
                                          <div class="col-md-12">
                                             <fieldset class="form-group">
                                                <label>Email Address</label>
                                                <input type="text" class="form-control" name="register_email" id="register_email" placeholder="Enter Email Address">
                                             </fieldset>
                                          </div>
                                          <div class="col-md-12">
                                             <fieldset class="form-group">
                                                <label>Password</label>
                                                <input type="password" class="form-control" name="register_password" id="register_password" placeholder="********">
                                             </fieldset>
                                          </div>
                                          <div class="col-md-12">
                                             <fieldset class="form-group">
                                                <label>Confirm Password </label>
                                                <input type="password" class="form-control" name="register_confirm_password" id="register_confirm_password" placeholder="********">
                                             </fieldset>
                                          </div>
                                          <div class="col-md-12">
                                             <fieldset class="form-group">
                                                <button type="submit" class="btn btn-lg btn-secondary btn-block">Create Your Account</button>
                                             </fieldset>
                                          </div>
                                       </div>
                                    </form>
                                 </div>
                              </div>
                              <div class="clearfix"></div>
                              <div class="text-center login-footer-tab">
                                 <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                       <a class="nav-link active" data-toggle="tab" href="#login" role="tab"><i class="mdi mdi-lock"></i> LOGIN</a>
                                    </li>
                                    <li class="nav-item">
                                       <a class="nav-link" data-toggle="tab" href="#register" role="tab"><i class="mdi mdi-pencil"></i> REGISTER</a>
                                    </li>
                                 </ul>
                              </div>
                              <div class="clearfix"></div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- / -->

      <!-- main menu -->
      <nav class="navbar navbar-light navbar-expand-lg bg-dark1 bg-mac-and-cheese bg-faded osahan-menu">
         <div class="container-fluid">
            <a class="navbar-brand text-white" href="{{ route('site.home') }}">
               <i class="mdi mdi-silverware"></i>
               D'Hungry Buddy
            </a>
               <a class="location-top" href="#"><i class="mdi mdi-map-marker-circle" aria-hidden="true"></i> Metro Manila</a>
            <button class="navbar-toggler navbar-toggler-white" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse" id="navbarNavDropdown">
               <div class="navbar-nav mr-auto mt-2 mt-lg-0 margin-auto top-categories-search-main">
                  <div class="top-categories-search">
                     <div class="input-group">
                        <input class="form-control" placeholder="search dishes" aria-label="search dishes" type="text">
                        <span class="input-group-btn">
                        <button class="btn btn-secondary" type="button"><i class="mdi mdi-file-find"></i> Search</button>
                        </span>
                     </div>
                  </div>
               </div>
               <div class="my-2 my-lg-0">
                  <ul class="list-inline main-nav-right">
                     @if(Auth::check())
                        <li class="list-inline-item dropdown osahan-top-dropdown">
                           <a class="btn btn-theme-round dropdown-toggle dropdown-toggle-top-user" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <img alt="logo" src="{{ asset('site-template/img/default-avatar.png') }}" />
                              <strong>Hi</strong> {{ Auth::user()->firstname }}
                           </a>
                           <div class="dropdown-menu dropdown-menu-right dropdown-list-design">
                              <a href="{{ route('redirect') }}" class="dropdown-item"><i aria-hidden="true" class="mdi mdi-home-outline"></i>  Dashboard</a>
                              {{-- <a href="my-address.html" class="dropdown-item"><i aria-hidden="true" class="mdi mdi-map-marker-circle"></i>  My Address</a>
                              <a href="wishlist.html" class="dropdown-item"><i aria-hidden="true" class="mdi mdi-heart-outline"></i>  Wish List </a>
                              <a href="orderlist.html" class="dropdown-item"><i aria-hidden="true" class="mdi mdi-format-list-bulleted"></i>  Order List</a> --}}
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" 
                                 href="{{ route('logout') }}"
                                 onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                              >
                                 <i class="mdi mdi-lock"></i> 
                                 Logout
                              </a>
                              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                 @csrf
                              </form>
                           </div>
                        </li>
                     @else
                        <li class="list-inline-item">
                           <a href="#" data-target="#bd-example-modal" data-toggle="modal" class="btn btn-link"><i class="mdi mdi-account-circle"></i> Login/Sign Up</a>
                        </li>
                     @endif
                     <li class="list-inline-item cart-btn">
                        <a href="#" data-toggle="offcanvas" class="btn btn-link border-none">
                           <i class="mdi mdi-cart"></i> 
                           My Cart <small class="cart-value">{{ $totalCartItems??0 }}</small>
                        </a>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </nav>
      <!-- / -->

      <!-- sub menu -->
      <nav class="navbar navbar-expand-lg navbar-light osahan-menu-2 pad-none-mobile">
         <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarText">
               <ul class="navbar-nav mr-auto mt-2 mt-lg-0 margin-auto">
                  <li class="nav-item">
                     <a class="nav-link shop" href="{{ route('site.home') }}"><span class="mdi mdi-store"></span> Menu</a>
                  </li>
                        <li class="nav-item">
                     <a href="{{ route('site.home') }}" class="nav-link">Home</a>
                  </li>
                        <li class="nav-item">
                     <a href="{{ route('site.about_us') }}" class="nav-link">About Us</a>
                  </li>
               </ul>
            </div>
         </div>
      </nav>
      <!-- / -->

      @yield('content')

      <!-- footer -->
      <section class="section-padding footer bg-white border-top">
         <div class="container">
            <div class="row">
               <div class="col-lg-3 col-md-3">
                  <h4 class="mb-3 mt-0">
                     <a class="logo" href="index.html">
                        <i class="mdi mdi-silverware"></i>
                        D'Hungry Buddy
                     </a>
                  </h4>
                  <p class="mb-0"><a class="text-dark" href="#!"><i class="mdi mdi-phone"></i> +639271570769</a></p>
                  <p class="mb-0"><a class="text-dark" href="#!"><i class="mdi mdi-cellphone-iphone"></i> +639353386587</a></p>
                  <p class="mb-0"><a class="text-dark" href="#!">Manila, Philippines</a></p>
               </div>
               <div class="col-lg-2 col-md-2">
                  <h6 class="mb-4">BRANCHES</h6>
                  <ul>
                     <li><a href="#!">Fairview, Quezon City</a></li>
                     <li><a href="#!">Orion, Bataan</a></li>
                  <ul>
               </div>
               <div class="col-lg-2 col-md-2">
                  <h6 class="mb-4">NAVIGATION</h6>
                  <ul>
                     <li><a href="{{ route('site.home') }}">Home</a></li>
                     <li><a href="{{ route('site.about_us') }}">About Us</a></li>
                  <ul>
               </div>
               <div class="col-lg-2 col-md-2">
                  <h6 class="mb-4">ABOUT US</h6>
                  <ul>
                     <li><a href="#">Company Information</a></li>
                     <li><a href="#">Store Location</a></li>
                     <li><a href="#">Copyright</a></li>
                  <ul>
               </div>
               <div class="col-lg-3 col-md-3">
                  <h6 class="mb-3 mt-0">GET IN TOUCH</h6>
                  <div class="footer-social">
                     <a class="btn-facebook" href="https://www.facebook.com/dhungrybud" target="_blank"><i class="mdi mdi-facebook"></i></a>
                     <a class="btn-messenger" href="https://www.facebook.com/dhungrybud"><i class="mdi mdi-facebook-messenger"></i></a>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- / -->

      <!-- copyright -->
      <section class="pt-4 pb-4 footer-bottom">
         <div class="container">
               <div class="row no-gutters">
                  <div class="col-lg-6 col-sm-6">
                     <p class="mt-1 mb-0">&copy; Copyright 2022 <strong class="text-dark"><i class="mdi mdi-silverware"></i> D'Hungry Buddy</strong>. All Rights Reserved</p>
                  </div>
               </div>
         </div>
      </section>
      <!-- / -->

      <!-- cart sidebar -->
      <div class="cart-sidebar">
         <div class="cart-sidebar-header">
            <h5>
               My Cart <span class="text-secondary">({{ $totalCartItems?? 0 }} item/s)</span> 
               <a data-toggle="offcanvas" class="float-right" href="#"><i class="mdi mdi-close"></i></a>
            </h5>
         </div>
         <div class="cart-sidebar-body">
            @if($cartItems && count($cartItems) > 0)
               <div class="cart-list-product">
                  <a href="{{ route('cart.empty_cart') }}" class="btn btn-md btn-danger" onclick="return confirm('Empty your cart?')">
                     <i class="mdi mdi-cart"></i>
                     Empty Cart
                  </a>
               </div>
               @foreach($cartItems as $cartItem)
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
            @else
               <div class="cart-list-product">
                  <h5>Your cart is empty.</h5>
               </div>
            @endif
         </div>
         @if($cartItems && count($cartItems) > 0)
         <div class="cart-sidebar-footer">
            <div class="cart-store-details">
               <p>Sub Total <strong class="float-right">₱{{ $subTotal?? 0 }}</strong></p>
               <p>Delivery Charges <strong class="float-right text-danger">+ ₱0.00</strong></p>
               <h6>VAT (12%) <strong class="float-right text-danger">₱12.60</strong></h6>
            </div>
            <a href="{{ route('checkout.index') }}">
               <button class="btn btn-secondary btn-lg btn-block text-left" type="button">
                  <span class="float-left">
                     <i class="mdi mdi-cart-outline"></i> 
                     Proceed to Checkout 
                  </span>
                  <span class="float-right">
                     <strong>₱{{ $subTotal }}</strong> 
                     <span class="mdi mdi-chevron-right"></span>
                  </span>
               </button>
            </a>
         </div>
         @endif
      </div>
      <!-- / -->

      <!-- Bootstrap core JavaScript -->
      <script src="{{ asset('site-template/vendor/jquery/jquery.min.js') }}"></script>
      <script src="{{ asset('site-template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
      <!-- select2 Js -->
      <script src="{{ asset('site-template/vendor/select2/js/select2.min.js') }}"></script>
      <!-- Owl Carousel -->
      <script src="{{ asset('site-template/vendor/owl-carousel/owl.carousel.js') }}"></script>
      <!-- Data Tables -->
      <link href="{{ asset('site-template/vendor/datatables/datatables.min.css') }}" rel="stylesheet" />
      <script src="{{ asset('site-template/vendor/datatables/datatables.min.js') }}"></script>
      <script>
         $(document).ready(function() {
            $('.orderlist-tbl').DataTable({
               language: {
                  emptyTable: 'No data to display.'
               },
               pageLength: 10,
               aLengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
               order: [[ 1, "desc" ]]
            });
         });
      </script>

      <!-- Custom -->
      <script src="{{ asset('site-template/js/custom.js') }}"></script>

      <script>
         $('#loginModalForm').submit(function(e) {
            e.preventDefault();
            let loginEmail = $('#login_email').val();
            let loginPassword = $('#login_password').val();
            let token = $('input[name="_token"').val();

            $.ajax({
               url: '{{ url("authenticate") }}',
               type: 'POST',
               data: {
                  '_token': token,
                  'email': loginEmail,
                  'password': loginPassword
               },
               success: function(res) {
                  console.log(res);
                  if (res.status == 'failed') {
                     $('#loginAlertMsg').html(`
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                           ${res.message}
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                        </div>
                     `);
                  } else {
                     window.location.href = '{{ route('redirect') }}';
                  }
               },
               error: function(err) {
                  console.log(err);
               }
            });
         });

         $('#registerModalForm').submit(function(e) {
            e.preventDefault();
            let firstname = $('#firstname').val();
            let lastname = $('#lastname').val();
            let contactNo = $('#contact_no').val();
            let registerEmail = $('#register_email').val();
            let registerPassword = $('#register_password').val();
            let registerConfirmPassword = $('#register_confirm_password').val();
            let token = $('input[name="_token"').val();

            $.ajax({
               url: '{{ url("customer-registration") }}',
               type: 'POST',
               data: {
                  '_token': token,
                  'firstname': firstname,
                  'lastname': lastname,
                  'contact_no': contactNo,
                  'email': registerEmail,
                  'password': registerPassword,
                  'confirm_password': registerConfirmPassword
               },
               success: function(res) {
                  console.log(res);
                  $('#registerAlertMsg').empty();
                  $('#validationErrorDiv').css('display', 'none');
                  if (res.status == 'failed') {
                     $('#registerAlertMsg').html(`
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                           ${res.message}
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                        </div>
                     `);
                  } else {
                     $("#registerModalForm")[0].reset();
                     $('#registerAlertMsg').html(`
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                           ${res.message}
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                        </div>
                     `);
                  }
               },
               error: function(err) {
                  if (err.status === 422) {
                     const errors = $.parseJSON(err.responseText);
                     $('#registerAlertMsg').empty();
                     $('#validationErrorDiv').css('display', 'block');
                     $('#validationErrorDiv').find('ul').empty();
                     $.each(errors.errors, function (key, value) {
                        $('#validationErrorDiv').find('ul').append(`<li>${value[0]}</li>`);
                     });
                  }  
               }
            });
         });
      </script>

   </body>
</html>

