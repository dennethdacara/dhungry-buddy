@extends('layouts/cms_app')

@section('content')

<div class="container">

    <div class="crumbs">
        <ul id="breadcrumbs" class="breadcrumb">
            <li><a href="#!">Manage Products</a></li>
            <li class="current"><a href="#">Products</a></li>
        </ul>
        <ul class="crumb-buttons">
            <li>
                <a href="{{ route('products.create') }}">
                    <i class="icol-application-add"></i> <span>New</span>
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
        <div class="col-lg-12">
            <div class="widget">
                <div class="widget-header">
                    <h4>Products</h4>
                </div>
                <div class="widget-content">
                    <table class="table table-condensed table-striped table-bordered table-hover table-responsive" id="productsTbl" width="100%">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Thumbnail</th>
                                <th>Price</th>
                                <th>Excerpt</th>
                                <th>Sort</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>
                                    <a href="{{ route('products.edit', ['product' => $product->id]) }}">
                                        {{ $product->title }}
                                    </a>
                                </td>
                                <td>
                                    @if($product->thumbnail)
                                        <img src="{{ $product->thumbnail ? asset('uploads/products/'.$product->thumbnail) : '' }}" width="50" />
                                    @endif
                                </td>
                                <td>₱{{ $product->price }}</td>
                                <td>{{ $product->excerpt }}</td>
                                <td>{{ $product->sort }}</td>
                                <td>{{ $product->created_at }}</td>
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
    $('#productsTbl').DataTable({
        language: {
            emptyTable: 'No data to display.'
        },
        pageLength: 10,
        aLengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
        order: [[ 4, "asc" ]]
    });
</script>

@stop