@extends('layouts.site_app')

@section('content')

<section class="checkout-page section-padding mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <div class="col-lg-10 col-md-10 mx-auto order-done">
                                <i class="mdi mdi-check-circle-outline text-secondary"></i>
                                <h4 class="text-success">Your Order has been Accepted.</h4>
                                <p>
                                    We'll notify you regarding the status of your order.
                                </p>
                            </div>
                            <div class="text-center">
                                <a href="{{ route('orderlist.index') }}"><button type="submit" class="btn btn-secondary mb-2 btn-lg">Return to my account</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@stop