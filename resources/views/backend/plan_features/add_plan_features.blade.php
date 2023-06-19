@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Plan FEATURE</li>
                </li>
            </ol>
            <a href="{{ route('planFeatures.index') }}" class="btn btn-inverse-info">Show All Plan</a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Add Plan Feature</h6>
                        {{ Form::open(['route' => 'planFeatures.store', 'class' => 'forms-sample', 'method' => 'post']) }}
                        <div class="row">

                            <div class="mb-3">

                                {!! Form::label('features_name', 'Feature Name', ['class' => 'form-label']) !!}

                                {!! Form::text('features_name', $value = null, ['class' => 'form-control', 'placeholder' => 'Feature Name']) !!}
                                @error('features_name')
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
