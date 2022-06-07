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
                <a href="{{ route('homepage-sliders.index') }}">
                    <i class="icol-arrow-undo"></i> <span>Back</span>
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('homepage-sliders.destroy', ['homepage_slider' => $slider->id]) }}">
                    <input type="hidden" name="_method" value="DELETE" />
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <button type="submit" class="btn" style="margin-top: 3px;" onclick="return confirm('Delete this item?');">
                        <i class="icol-application-delete"></i> <span>Delete</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>

    <div class="page-header"></div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @include('cms/partials/message')
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="widget box">
                <div class="widget-header">
                    <h4>Edit Homepage Slider</h4>
                </div>
                <div class="widget-content">
                    <form method="POST" action="{{ route('homepage-sliders.update', ['homepage_slider' => $slider->id]) }}" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="slider_id" value="{{$slider->id}}">
                        @csrf

                        <div class="text-center">
                            <img
                                src="{{ $slider->thumbnail
                                    ? asset('uploads/sliders/'.$slider->thumbnail)
                                    : 'slider-thumbnail' }}"
                            />
                        </div>

                        <br />

                        <div class="form-group">
                            <label class="required">Title</label>
                            <input 
                                type="text" 
                                class="form-control"
                                name="title"
                                value="{{ $slider->title }}"
                                placeholder="Ex. Slider #1"
                            />
                        </div>

                        <div class="form-group">
                            <label>Thumbnail / Banner</label>
                            <input
                                type="file"
                                name="thumbnail"
                            />
                        </div>

                        <div class="form-group">
                            <label class="required">Sort</label>
                            <input
                                type="number"
                                class="form-control"
                                name="sort"
                                value="{{ $slider->sort }}"
                            />
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-md btn-success pull-right" id="submitBtn">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</div>

@stop