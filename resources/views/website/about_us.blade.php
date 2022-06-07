@extends('layouts.site_app')

@section('content')

<!-- Inner Header -->
<section class="section-padding bg-dark inner-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="mt-0 mb-3 text-white">About Us</h1>
                <div class="breadcrumbs">
                    <p class="mb-0 text-white"><a class="text-white" href="#">Home</a>  /  <span class="text-secondary">About Us</span></p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Inner Header -->

<!-- About -->
<section class="section-padding bg-white">
    <div class="container">
        <div class="row">
            <div class="pl-4 col-lg-5 col-md-5 pr-4">
                <img class="rounded img-fluid" src="{{ asset('site-template/images/about-us-banner.jpg') }}" alt="Card image cap">
            </div>
            <div class="col-lg-6 col-md-6 pl-5 pr-5">
                <h2 class="mt-5 mb-5 text-secondary">Level Up Your Cheesy Craving!</h2>
                <h5 class="mt-2">Our Vision</h5>
                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here,</p>
                <h5 class="mt-4">Our Goal</h5>
                <p>When looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, Lorem Ipsum has been the industry's standard dummy text ever since.</p>
            </div>
        </div>
    </div>
</section>
<!-- End About -->

<!-- What We Provide -->
<section class="section-padding">
    <div class="section-title text-center mb-5">
        <h2>What We Provide?</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="mt-4 mb-4"><i class="text-secondary mdi mdi-shopping mdi-48px"></i></div>
                <h5 class="mt-3 mb-3 text-secondary">Best Prices & Offers</h5>
                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour.</p>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="mt-4 mb-4"><i class="text-secondary mdi mdi-earth mdi-48px"></i></div>
                <h5 class="mb-3 text-secondary">Wide Assortment</h5>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text eve.</p>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="mt-4 mb-4"><i class="text-secondary mdi mdi-refresh mdi-48px"></i></div>
                <h5 class="mt-3 mb-3 text-secondary">Easy Returns</h5>
                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="mt-4 mb-4"><i class="text-secondary mdi mdi-truck-fast mdi-48px"></i></div>
                <h5 class="mb-3 text-secondary">Free & Next Day Delivery</h5>
                <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC.</p>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="mt-4 mb-4"><i class="text-secondary mdi mdi-basket mdi-48px"></i></div>
                <h5 class="mt-3 mb-3 text-secondary">100% Satisfaction Guarantee</h5>
                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour.</p>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="mt-4 mb-4"><i class="text-secondary mdi mdi mdi-tag-heart mdi-48px"></i></div>
                <h5 class="mt-3 mb-3 text-secondary">Great Daily Deals Discount</h5>
                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using.</p>
            </div>
       </div>
    </div>
</section>
<!-- End What We Provide -->

<!-- Our Team -->
<section class="section-padding bg-white">
    <div class="section-title text-center mb-5">
       <h2>Our Team</h2>
    </div>
    <div class="container">
        <div class="row">
            @foreach($members as $member)
                <div class="col-lg-3 col-md-3">
                    <div class="team-card text-center">
                        <img 
                            class="img-fluid mb-4" 
                            src="{{ $member->thumbnail ? asset('uploads/members/'.$member->thumbnail) : '' }}" 
                            alt="{{ $member->title }}" 
                        />
                        <p class="mb-4">{{ $member->excerpt }}</p>
                        <h6 class="mb-0 text-secondary">- {{ $member->name }}</h6>
                        <small>{{ $member->position }}</small>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- End Our Team -->

@stop