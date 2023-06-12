@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Cities</li>
                </li>
            </ol>
            <a href="{{ route('cities.index') }}" class="btn btn-inverse-info">Show All Cities</a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Add City</h6>

                        {{ Form::open(['route' => 'cities.store', 'class' => 'forms-sample', 'method' => 'post']) }}
                        <div class="mb-3">
                            {!! Form::label('country_id', 'Country Name', ['class' => 'form-label']) !!}

                            {!! Form::Select('country_id', $countries, null, [
                                'class' => 'form-control',
                                'id' => 'countryinfo',
                                'placeholder' => 'Select Country',
                            ]) !!}

                        </div>
                        <div class="mb-3">
                            {!! Form::label('state_id', 'State Name', ['class' => 'form-label']) !!}

                            {!! Form::Select('state_id', $states, null, [
                                'class' => 'form-control',
                                'id' => 'statesinfo',
                                'placeholder' => 'Select State',
                            ]) !!}

                        </div>
                        <div class="mb-3">

                            {!! Form::label('name', 'Name', ['class' => 'form-label']) !!}

                            {!! Form::text('name', $value = null, [
                                'class' => 'form-control',
                                'placeholder' => 'Name',
                            ]) !!}
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
    <script>
        $(document).ready(function() {
            $('#countryinfo').on('change', function() {
                var country_id = this.value;
                var crf = '{{ csrf_token() }}';
                $.ajax({
                    url: "{{ route('cities.states') }}",
                    type: "POST",
                    data: {
                        _token: crf,
                        country_id: country_id
                    },
                    cache: false,
                    success: function(result) {
                        $("#statesinfo").html(result);
                    }
                });
            });


        });
    </script>
@endsection
