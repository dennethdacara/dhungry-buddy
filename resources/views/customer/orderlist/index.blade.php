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
                                    Order List
                                </h5>
                            </div>
                            <div class="order-list-tabel-main table-responsive">
                                <table class="orderlist-tbl table table-striped table-bordered order-list-tabel" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Order #</th>
                                            <th>Date Purchased</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                            <th>Remarks</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $order)
                                        <tr>
                                            <td>{{ $order->order_no }}</td>
                                            <td>{{ $order->formatted_created_at }}</td>
                                            <td>
                                                @if($order->status == 'Pending')
                                                    <span class="badge badge-info">
                                                        {{ $order->status }}
                                                    </span>
                                                @elseif($order->status == 'Delivered')
                                                    <span class="badge badge-success">
                                                        {{ $order->status }}
                                                    </span>
                                                @elseif($order->status == 'Cancelled')
                                                    <span class="badge badge-danger">
                                                        {{ $order->status }}
                                                    </span>
                                                @else
                                                    <span class="badge badge-info">
                                                        {{ $order->status }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td>₱{{ $order->total_amount }}</td>
                                            <td>{{ $order->remarks }}</td>
                                            <td><a href="#" class="btn btn-secondary btn-sm">View</a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </div>
      </div>
   </div>
</section>

@stop