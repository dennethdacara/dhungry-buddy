@extends('layouts/cms_app')

@section('content')

<div class="container">
    <div class="crumbs">
        <ul id="breadcrumbs" class="breadcrumb">
            <li><a href="#!">Manage Orders</a></li>
            <li class="current"><a href="#">Orders</a></li>
        </ul>
        <ul class="crumb-buttons">
            <li>
                <a href="{{ route('orders.index') }}">
                    <i class="icol-arrow-undo"></i> <span>Back</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="page-header"></div>

    <div class="row">
        <div class="col-md-12">
            @include('cms/partials/message')
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-header">
                    <h4>View Order Details</h4>
                </div>
                <div class="widget-content">
                    <form method="POST" action="{{ route('orders.update', ['order' => $order->id]) }}" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-8">
                                <table class="table table-bordered table-hover table-striped">
                                    <tr>
                                        <th width="150px">Order No.</th>
                                        <td>{{ $order->order_no }}</td>
                                    </tr>
                                    <tr>
                                        <th width="150px">Status</th>
                                        <td>{{ $order->status }}</td>
                                    </tr>
                                    <tr>
                                        <th>Date Purchased:</th>
                                        <td>{{ $order->created_at }}</td>
                                    </tr>
                                    <tr>
                                        <th>Purchased By:</th>
                                        <td>{{ $order->purchased_by }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email Address:</th>
                                        <td>{{ $order->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Contact No.</th>
                                        <td>{{ $order->contact_no }}</td>
                                    </tr>
                                    <tr>
                                        <th>Delivery Address:</th>
                                        <td>
                                            Address Line 1: {{ $order->address_line_1 }} <br />
                                            Unit/Block/Street: {{ $order->unit_block_street }} <br />
                                            Zipcode: {{ $order->zipcode }}
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-md-4">
                                <div class="well">
                                    <div class="card card-body bg-light mb-3">
                                        <table style="width: 100%;" id="orderDetailsTbl">
                                            <thead>
                                                <tr>
                                                    <th colspan="2">Order Details</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($orderDetails) > 0)
                                                    @foreach($orderDetails as $orderDetail)
                                                    <tr>
                                                        <td><i class="text-muted">{{ $orderDetail->product_name }} x{{ $orderDetail->qty }}</i></td>
                                                        <td class="text-muted pull-right pr-2">
                                                            {{ $orderDetail->total_amount }}
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    <tr><td colspan="2"><hr /></td></tr>
                                                    <tr>
                                                        <td><b>Total:</b></td>
                                                        <td class="text-bold pull-right pr-2">
                                                            ₱{{ $order->total_amount }}
                                                        </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h3>Order History</h3>
        
                                <div style="overflow-x:auto;">
                                    <table class="table table-condensed table-bordered table-hover table-striped no-wrap" id="applicationHistoryTbl">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Status</th>
                                                <th>Remarks</th>
                                                <th>Date Processed</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($orderHistories as $key => $orderHistory)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $orderHistory->status }}</td>
                                                <td>{{ $orderHistory->remarks }}</td>
                                                <td>{{ $orderHistory->formatted_created_at }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <hr />

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="required">Order Status</label>
                                    <select name="order_status_id" id="order_status_id" class="form-control">
                                        <option value="">-Select Order Status-</option>
                                        @foreach($orderStatuses as $status)
                                            <option value="{{ $status->id }}"
                                                {{ $status->id == old('order_status_id') ? 'selected' : '' }}>
                                                {{ $status->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Remarks</label>
                                    <textarea 
                                        name="remarks" 
                                        class="form-control" 
                                        id="remarks" 
                                        cols="30" 
                                        rows="3"
                                    >{{ old('remarks') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <br />

                        {{-- <div class="form-group">
                            <label class="required">Name</label>
                            <input 
                                type="text" 
                                class="form-control"
                                name="name"
                                value="{{ $category->name }}"
                                placeholder="Ex. Rice Meal"
                            />
                        </div>

                        <div class="form-group">
                            <label>Parent Category</label>
                            <select name="parent_id" id="parent_id" class="form-control">
                                <option value="">-Select Option-</option>
                                @foreach($parentCategories as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ $cat->id == $category->parent_id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="required">Sort</label>
                            <input
                                type="number"
                                class="form-control"
                                name="sort"
                                value="{{ $category->sort }}"
                            />
                        </div> --}}

                        <div class="form-actions">
                            <button type="submit" class="btn btn-md btn-success pull-right" id="submitBtn" onclick="return confirm('Save changes?')">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</div>

@stop