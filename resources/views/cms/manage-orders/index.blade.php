@extends('layouts/cms_app')

@section('content')

<div class="container">

    <div class="crumbs">
        <ul id="breadcrumbs" class="breadcrumb">
            <li><a href="#!">Manage Orders</a></li>
            <li class="current"><a href="#">Orders</a></li>
        </ul>
    </div>

    <div class="page-header"></div>

    <div class="row">
        <div class="col-md-12">
            @include('cms/partials/message')
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="widget">
                <div class="widget-header">
                    <h4>Manage Orders</h4>
                </div>
                <div class="widget-content">
                    <table class="table table-condensed table-striped table-bordered table-hover table-responsive" id="ordersTbl" width="100%">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Purchased By</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Remarks</th>
                                <th>Date Purchased</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>
                                    <a href="{{ route('orders.edit', ['order' => $order->id]) }}">
                                        {{ $order->order_no }}
                                    </a>
                                </td>
                                <td>{{ $order->firstname . ' ' . $order->lastname }}</td>
                                <td>₱{{ $order->total_amount }}</td>
                                <td>
                                    @if($order->status == 'Pending')
                                        <span class="label label-default">
                                            {{ $order->status }}
                                        </span>
                                    @elseif($order->status == 'Delivered')
                                        <span class="label label-success">
                                            {{ $order->status }}
                                        </span>
                                    @elseif($order->status == 'Cancelled')
                                        <span class="label label-danger">
                                            {{ $order->status }}
                                        </span>
                                    @else
                                        <span class="label label-info">
                                            {{ $order->status }}
                                        </span>
                                    @endif
                                </td>
                                <td>{{ $order->remarks }}</td>
                                <td>{{ $order->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    $('#ordersTbl').DataTable({
        language: {
            emptyTable: 'No data to display.'
        },
        pageLength: 10,
        aLengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
        order: [[ 5, "desc" ]]
    });
</script>

@stop