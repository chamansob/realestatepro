@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Agent</li>
                </li>
            </ol>
            <a href="{{ route('admin.agents') }}" class="btn btn-inverse-info">All Agent</a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Edit Agent</h6>
                        {!! Form::open([
                            'method' => 'put',
                            'route' => ['admin.agent_update'],
                            'files' => true,
                            'class' => 'forms-sample',
                        ]) !!}
                        <div class="mb-3">
                            <img class="wd-70 rounded-circle" id="showImage"
                                src="{{ !empty($agent->photo) ? asset($agent->photo) : url('upload/no_image.jpg') }}"
                                alt="profile">
                        </div>
                        <div class="mb-3">
                            <x-input-label for="photo" :value="__('Photo')" />
                            <x-text-input id="photo" class="form-control" type="file" name="photo"
                                id="image" />
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">



                                    {!! Form::label('username', 'Agent Username', ['class' => 'form-label']) !!}

                                    {!! Form::text('username', $value = $agent->username, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Agent Username',
                                    ]) !!}
                                    @error('username')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    {!! Form::hidden('agent_id', $value = $agent->id) !!}


                                    {!! Form::label('name', 'Agent Name', ['class' => 'form-label']) !!}

                                    {!! Form::text('name', $value = $agent->name, ['class' => 'form-control', 'placeholder' => 'Agent Name']) !!}
                                    @error('name')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">

                                    {!! Form::label('email', 'Agent Email', ['class' => 'form-label']) !!}

                                    {!! Form::email('email', $value = $agent->email, ['class' => 'form-control', 'placeholder' => 'Agent Email']) !!}
                                    @error('email')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">

                                    {!! Form::label('phone', 'Agent Phone', ['class' => 'form-label']) !!}

                                    {!! Form::text('phone', $value = $agent->phone, ['class' => 'form-control', 'placeholder' => 'Agent Phone']) !!}
                                    @error('phone')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">

                                    {!! Form::label('password', 'Password', ['class' => 'form-label']) !!}
                                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Agent Password']) !!}
                                    @error('password')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">

                                    {!! Form::label('address', 'Agent Address', ['class' => 'form-label']) !!}

                                    {!! Form::textarea('address', $value = $agent->address, [
                                        'class' => 'form-control',
                                        'rows' => 3,
                                        'placeholder' => 'Agent Address',
                                    ]) !!}
                                    @error('address')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>



                        <div class="mb-3">
                            <?php
                            $status = [
                                '0' => 'Active',
                                '1' => 'Inactive',
                            ];
                            ?>
                            {!! Form::label('status', 'Status', ['class' => 'form-label']) !!}

                            {!! Form::Select('status', $status, $agent->status, [
                                'class' => 'form-control',
                                'placeholder' => 'Select Status',
                            ]) !!}
                            @error('status')
                                <span class="text-danger pt-3">{{ $message }}</span>
                            @enderror
                        </div>
                        {!! Form::submit('Update', ['class' => 'btn btn-outline-primary btn-icon-text mb-2 mb-md-0']) !!}
                        {{ Form::close() }}

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
