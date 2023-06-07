@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Property Type All</li>
                </li>
            </ol>
            <a href="{{ route('property_types.index') }}" class="btn btn-inverse-info">Show All Type Property</a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Add Property Type</h6>
                        {{ Form::open(['route' => 'property_types.store', 'class' => 'forms-sample', 'method' => 'post']) }}

                        <div class="mb-3">

                            {!! Form::label('type_name', 'Property Type Name', ['class' => 'form-label']) !!}

                            {!! Form::text('type_name', $value = null, ['class' => 'form-control', 'placeholder' => 'Property Type Name']) !!}
                            @error('type_name')
                                <span class="text-danger pt-3">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            {!! Form::label('type_icon', 'Property Icon', ['class' => 'form-label']) !!}
                            {!! Form::text('type_icon', $value = null, [
                                'class' => 'form-control',
                                'placeholder' => 'Property Icon',
                            ]) !!}
                            @error('type_icon')
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
