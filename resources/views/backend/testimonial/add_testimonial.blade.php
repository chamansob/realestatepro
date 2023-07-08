@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Testimonials</li>
                </li>
            </ol>
            <a href="{{ route('testimonials.index') }}" class="btn btn-inverse-info">Show All Testimonials</a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Add Testimonial</h6>

                        {{ Form::open(['route' => 'testimonials.store', 'class' => 'forms-sample', 'method' => 'post', 'files' => true]) }}
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">

                                    {!! Form::label('name', 'Name', ['class' => 'form-label']) !!}

                                    {!! Form::text('name', $value = null, ['class' => 'form-control', 'placeholder' => 'Name']) !!}
                                    @error('name')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    {!! Form::label('position', 'Position', ['class' => 'form-label']) !!}

                                    {!! Form::text('position', $value = null, ['class' => 'form-control', 'placeholder' => 'Position']) !!}
                                    @error('position')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row">

                            <div class="mb-3">

                                {!! Form::label('image', 'Image', ['class' => 'form-label']) !!}

                                {!! Form::file('image', [
                                    'class' => 'form-control',
                                    'placeholder' => 'Main Thumbnail',
                                    'onchange' => 'mainThamUrl(this)',
                                ]) !!}
                                @error('state_image')
                                    <span class="text-danger pt-3">{{ $message }}</span>
                                @enderror
                                <img src="" id="mainThmb">

                            </div>

                        </div>
                        <div class="row">

                            <div class="mb-3">

                                {!! Form::label('message', 'Message', ['class' => 'form-label']) !!}

                                {!! Form::textarea('message', $value = null, [
                                    'class' => 'form-control',
                                    'id' => 'tinymceExample',
                                    'rows' => 2,
                                    'placeholder' => 'Message',
                                ]) !!}
                                @error('message')
                                    <span class="text-danger pt-3">{{ $message }}</span>
                                @enderror

                            </div>

                        </div>
                        {!! Form::submit('Submit', ['class' => 'btn btn-outline-primary btn-icon-text mb-2 mb-md-0']) !!}
                        {{ Form::close() }}

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
