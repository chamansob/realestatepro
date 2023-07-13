@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Tag</li>
                </li>
            </ol>
            <a href="{{ route('blog_tag.index') }}" class="btn btn-inverse-info">Show All Tags</a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Edit Tag</h6>
                        {!! Form::open([
                            'method' => 'put',
                            'route' => ['blog_tag.update', $blog_tag->id],
                            'class' => 'forms-sample',
                        ]) !!}
                        <div class="mb-3">

                            {!! Form::label('name', 'Tag Name', ['class' => 'form-label']) !!}

                            {!! Form::text('tag_name', $value = $blog_tag->tag_name, [
                                'class' => 'form-control',
                                'placeholder' => 'Tag Name',
                            ]) !!}
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
