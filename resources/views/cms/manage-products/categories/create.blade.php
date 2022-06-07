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
                <a href="{{ route('categories.index') }}">
                    <i class="icol-arrow-undo"></i> <span>Back</span>
                </a>
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
                    <h4>New Category</h4>
                </div>
                <div class="widget-content">
                    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label class="required">Name</label>
                            <input 
                                type="text" 
                                class="form-control"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Ex. Rice Meal"
                            />
                        </div>

                        <div class="form-group">
                            <label>Parent Category</label>
                            <select name="parent_id" id="parent_id" class="form-control">
                                <option value="">-Select Option-</option>
                                @foreach($parentCategories as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ $cat->id == old('parent_id') ? 'selected' : '' }}>
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
                                value="{{ old('sort') ? old('sort') : 1 }}"
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