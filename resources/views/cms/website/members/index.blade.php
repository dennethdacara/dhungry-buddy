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
                <a href="{{ route('members.create') }}">
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
                    <h4>About Us - Members</h4>
                </div>
                <div class="widget-content">
                    <table class="table table-condensed table-striped table-bordered table-hover table-responsive" id="membersTbl" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Thumbnail</th>
                                <th>Position</th>
                                <th>Excerpt</th>
                                <th>Sort</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($members as $member)
                            <tr>
                                <td>
                                    <a href="{{ route('members.edit', ['member' => $member->id]) }}">
                                        {{ $member->name }}
                                    </a>
                                </td>
                                <td>
                                    @if($member->thumbnail)
                                        <img src="{{ $member->thumbnail ? asset('uploads/members/'.$member->thumbnail) : '' }}" width="50" />
                                    @endif
                                </td>
                                <td>{{ $member->position }}</td>
                                <td>{{ $member->excerpt }}</td>
                                <td>{{ $member->sort }}</td>
                                <td>{{ $member->created_at }}</td>
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
    $('#membersTbl').DataTable({
        language: {
            emptyTable: 'No data to display.'
        },
        pageLength: 10,
        aLengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
        order: [[ 4, "asc" ]]
    });
</script>

@stop