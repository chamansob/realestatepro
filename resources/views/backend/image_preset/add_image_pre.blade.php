@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Image Preset</li>
                </li>
            </ol>
            <a href="{{ route('image_preset.index') }}" class="btn btn-inverse-info">Show All Image Preset</a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Add Image Preset</h6>
                        {{ Form::open(['route' => 'image_preset.store', 'class' => 'forms-sample', 'method' => 'post']) }}


                        <div class="row">
                            <div class="col-lg-4 mb-3">

                                {!! Form::label('name', 'Name', ['class' => 'form-label']) !!}

                                {!! Form::text('name', $value = null, [
                                    'class' => 'form-control',
                                    'placeholder' => 'Name',
                                ]) !!}
                                @error('name')
                                    <span class="text-danger pt-3">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-4 mb-3">

                                {!! Form::label('width', 'Width', ['class' => 'form-label']) !!}

                                {!! Form::text('width', $value = null, ['class' => 'form-control', 'placeholder' => 'Width']) !!}
                                @error('width')
                                    <span class="text-danger pt-3">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-4 mb-3">

                                {!! Form::label('height', 'Height', ['class' => 'form-label']) !!}

                                {!! Form::text('height', $value = null, ['class' => 'form-control', 'placeholder' => 'Height']) !!}
                                @error('height')
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
