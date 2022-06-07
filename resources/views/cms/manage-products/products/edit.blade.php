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
                <a href="{{ route('products.index') }}">
                    <i class="icol-arrow-undo"></i> <span>Back</span>
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('products.destroy', ['product' => $product->id]) }}">
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
                    <h4>Edit Product</h4>
                </div>
                <div class="widget-content">
                    <form method="POST" action="{{ route('products.update', ['product' => $product->id]) }}" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        @csrf

                        <div class="text-center">
                            <img
                                width="150"
                                src="{{ $product->thumbnail
                                    ? asset('uploads/products/'.$product->thumbnail)
                                    : 'product-thumbnail' }}"
                                
                            />
                        </div>

                        <br />

                        <div class="form-group">
                            <label class="required">Title</label>
                            <input 
                                type="text" 
                                class="form-control"
                                name="title"
                                value="{{ $product->title }}"
                                placeholder="Ex. Hotsilog"
                            />
                        </div>

                        <div class="form-group">
                            <label>Thumbnail</label>
                            <input
                                type="file"
                                name="thumbnail"
                            />
                        </div>

                        <div class="form-group">
                            <label>Excerpt</label>
                            <input 
                                type="text" 
                                class="form-control"
                                name="excerpt"
                                value="{{ $product->excerpt }}"
                                placeholder="Short Description"
                            />
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" id="description" cols="30" rows="2">{{ $product->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <label class="required">Price</label>
                            <input
                                type="number"
                                class="form-control"
                                id="price"
                                name="price"
                                step="0.01"
                                placeholder="Ex. 59.00"
                                value="{{ $product->price?? 0 }}"
                            />
                        </div>

                        <div class="form-group">
                            <label class="required">Product Type</label>
                            <select name="type" id="type" class="form-control">
                                <option value="Main" {{ $product->type == 'Main' ? 'selected' : '' }}>Main</option>
                                <option value="Add-On" {{ $product->type == 'Add-On' ? 'selected' : '' }}>Add-On</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="required">Sort</label>
                            <input
                                type="number"
                                class="form-control"
                                name="sort"
                                value="{{ $product->sort }}"
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