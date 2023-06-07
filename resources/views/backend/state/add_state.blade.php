@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">All States</li>
                </li>
            </ol>
            <a href="{{ route('states.index') }}" class="btn btn-inverse-info">Show All States</a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Add State</h6>

                        {{ Form::open(['route' => 'states.store', 'class' => 'forms-sample', 'method' => 'post']) }}
                        <div class="mb-3">
                            {!! Form::label('country_id', 'Country Name', ['class' => 'form-label']) !!}

                            {!! Form::Select('country_id', $countries, null, ['class' => 'form-control', 'placeholder' => 'Select County']) !!}

                        </div>
                        <div class="mb-3">

                            {!! Form::label('name', 'Name', ['class' => 'form-label']) !!}

                            {!! Form::text('name', $value = null, ['class' => 'form-control', 'placeholder' => 'Name']) !!}
                            @error('name')
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
