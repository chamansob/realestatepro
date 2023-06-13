@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Agents</li>
                </li>
            </ol>
            <a href="{{ route('admin.agents') }}" class="btn btn-inverse-info">All Agents</a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Add Agent</h6>

                        {{ Form::open(['route' => 'admin.agent_store', 'class' => 'forms-sample', 'method' => 'post']) }}

                        <div class="mb-3">

                            {!! Form::label('name', 'Agent Name', ['class' => 'form-label']) !!}

                            {!! Form::text('name', $value = null, ['class' => 'form-control', 'placeholder' => 'Agent Name']) !!}
                            @error('name')
                                <span class="text-danger pt-3">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">

                            {!! Form::label('email', 'Agent Email', ['class' => 'form-label']) !!}

                            {!! Form::email('email', $value = null, ['class' => 'form-control', 'placeholder' => 'Agent Email']) !!}
                            @error('email')
                                <span class="text-danger pt-3">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">

                            {!! Form::label('phone', 'Agent Phone', ['class' => 'form-label']) !!}

                            {!! Form::text('phone', $value = null, ['class' => 'form-control', 'placeholder' => 'Agent Phone']) !!}
                            @error('phone')
                                <span class="text-danger pt-3">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">

                            {!! Form::label('address', 'Agent Address', ['class' => 'form-label']) !!}

                            {!! Form::textarea('address', $value = null, [
                                'class' => 'form-control',
                                'rows' => 3,
                                'placeholder' => 'Agent Address',
                            ]) !!}
                            @error('address')
                                <span class="text-danger pt-3">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">

                            {!! Form::label('password', 'Password', ['class' => 'form-label']) !!}

                            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Agent Password']) !!}
                            @error('password')
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
