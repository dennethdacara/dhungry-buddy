@extends('layouts/cms_app')

@section('content')

<div class="container">

    <div class="crumbs">
        <ul id="breadcrumbs" class="breadcrumb">
            <li><a href="#!">Manage Products</a></li>
            <li class="current"><a href="#">Categories</a></li>
        </ul>
        <ul class="crumb-buttons">
            <li>
                <a href="{{ route('categories.create') }}">
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
                    <h4>Categories</h4>
                </div>
                <div class="widget-content">
                    <table class="table table-condensed table-striped table-bordered table-hover table-responsive" id="categoriesTbl" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parent Category</th>
                                <th>Sort</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td>
                                    <a href="{{ route('categories.edit', ['category' => $category->id]) }}">
                                        {{ $category->name }}
                                    </a>
                                </td>
                                <td>{{ $category->parent_category }}</td>
                                <td>{{ $category->sort }}</td>
                                <td>{{ $category->created_at }}</td>
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
    $('#categoriesTbl').DataTable({
        language: {
            emptyTable: 'No data to display.'
        },
        pageLength: 10,
        aLengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
        order: [[ 2, "asc" ]]
    });
</script>

@stop