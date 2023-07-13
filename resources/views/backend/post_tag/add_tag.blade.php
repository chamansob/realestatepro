@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Tags</li>
                </li>
            </ol>
            <a href="{{ route('blog_tag.index') }}" class="btn btn-inverse-info">Show All Tags</a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Add Tag</h6>
                        {{ Form::open(['route' => 'blog_tag.store', 'class' => 'forms-sample', 'method' => 'post']) }}

                        <div class="mb-3">

                            {!! Form::label('tag_name', 'Tag Name', ['class' => 'form-label']) !!}

                            {!! Form::text('tag_name', $value = null, ['class' => 'form-control', 'placeholder' => 'Tag Name']) !!}
                            @error('tag_name')
                                <span class="text-danger pt-3">{{ $message }}</span>
                            @enderror
                        </div>
                        {!! Form::submit('Submit', ['class' => 'btn btn-outline-primary btn-icon-text mb-2 mb-md-0']) !!}
                        {{ Form::close() }}

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
