@extends('layouts/cms_app')

@section('content')

<div class="container">
    <div class="crumbs">
        <ul id="breadcrumbs" class="breadcrumb">
            <li><a href="#!">Website</a></li>
            <li class="current"><a href="#">About Us - Members</a></li>
        </ul>
        <ul class="crumb-buttons">
            <li>
                <a href="{{ route('members.index') }}">
                    <i class="icol-arrow-undo"></i> <span>Back</span>
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('members.destroy', ['member' => $member->id]) }}">
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
                    <h4>Edit Member</h4>
                </div>
                <div class="widget-content">
                    <form method="POST" action="{{ route('members.update', ['member' => $member->id]) }}" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="member_id" value="{{$member->id}}">
                        @csrf

                        <div class="text-center">
                            <img
                                width="150"
                                src="{{ $member->thumbnail
                                    ? asset('uploads/members/'.$member->thumbnail)
                                    : 'member-thumbnail' }}"
                                
                            />
                        </div>

                        <br />

                        <div class="form-group">
                            <label class="required">Name</label>
                            <input 
                                type="text" 
                                class="form-control"
                                name="name"
                                value="{{ $member->name }}"
                                placeholder="Ex. Member #1"
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
                            <label class="required">Position:</label>
                            <input 
                                type="text" 
                                class="form-control"
                                name="position"
                                value="{{ $member->position }}"
                                placeholder="Ex. Developer"
                            />
                        </div>

                        <div class="form-group">
                            <label>Excerpt</label>
                            <input 
                                type="text" 
                                class="form-control"
                                name="excerpt"
                                value="{{ $member->excerpt }}"
                                placeholder="Short Description"
                            />
                        </div>

                        <div class="form-group">
                            <label class="required">Sort</label>
                            <input
                                type="number"
                                class="form-control"
                                name="sort"
                                value="{{ $member->sort }}"
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