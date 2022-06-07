@extends('layouts/cms_app')

@section('content')

<div class="container">

    <div class="crumbs">
        <ul id="breadcrumbs" class="breadcrumb">
            <li><a href="#!">Website</a></li>
            <li class="current"><a href="#">Homepage - Sliders</a></li>
        </ul>
        <ul class="crumb-buttons">
            <li>
                <a href="{{ route('homepage-sliders.create') }}">
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
                    <h4>Homepage - Sliders</h4>
                </div>
                <div class="widget-content">
                    <table class="table table-condensed table-striped table-bordered table-hover table-responsive" id="sliderTbl" width="100%">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Thumbnail</th>
                                <th>Sort</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sliders as $slider)
                            <tr>
                                <td>
                                    <a href="{{ route('homepage-sliders.edit', ['homepage_slider' => $slider->id]) }}">
                                        {{ $slider->title }}
                                    </a>
                                </td>
                                <td>
                                    @if($slider->thumbnail)
                                        <img src="{{ $slider->thumbnail ? asset('uploads/sliders/'.$slider->thumbnail) : '' }}" width="250px" />
                                    @endif
                                </td>
                                <td>{{ $slider->sort }}</td>
                                <td>{{ $slider->created_at }}</td>
                                <td>{{ $slider->updated_at }}</td>
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
    $('#sliderTbl').DataTable({
        language: {
            emptyTable: 'No data to display.'
        },
        pageLength: 10,
        aLengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
        order: [[ 2, "asc" ]]
    });
</script>

@stop