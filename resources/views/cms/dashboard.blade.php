@extends('layouts/cms_app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Dashboard</h3>
            <hr />
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 col-md-3">
            <div class="statbox widget box box-shadow">
                <div class="widget-content">
                    <div class="title">Total Orders</div>
                    <div class="value" style="margin-top: 5px;">{{ $totalOrders }}</div>
                    <a class="more" href="{{ route('orders.index') }}">
                        View More <i class="pull-right icon-angle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
</div>

@stop