@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit State</li>
                </li>
            </ol>
            <a href="{{ route('states.index') }}" class="btn btn-inverse-info">Show All States</a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Edit States</h6>
                        {!! Form::open([
                            'method' => 'put',
                            'route' => ['states.update', $state->id],
                            'class' => 'forms-sample',
                            'files' => true,
                        ]) !!}

                        <div class="mb-3">
                            {!! Form::label('country_id', 'Country Name', ['class' => 'form-label']) !!}

                            {!! Form::Select('country_id', $countries, $state->country_id, [
                                'class' => 'form-control',
                                'placeholder' => 'Select County',
                            ]) !!}
                            @error('country_id')
                                <span class="text-danger pt-3">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">

                            {!! Form::label('name', 'Name', ['class' => 'form-label']) !!}

                            {!! Form::text('name', $value = $state->name, ['class' => 'form-control', 'placeholder' => 'Name']) !!}
                            @error('name')
                                <span class="text-danger pt-3">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-sm-10">
                                <div class="mb-3">

                                    {!! Form::label('state_image', 'State Image', ['class' => 'form-label']) !!}

                                    {!! Form::file('state_image', [
                                        'class' => 'form-control',
                                        'placeholder' => 'State Image',
                                        'onchange' => 'mainThamUrl(this)',
                                    ]) !!}
                                    @error('state_image')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                    <div class="mt-3"><img src="" id="mainThmb"
                                            class="img-responsive border border-1">
                                    </div>
                                    <?php
                                    $img = explode('.', $state->state_image);
                                    $small_img = $img[0] . '_thumb.' . $img[1];
                                    ?>
                                    <div class="mt-3 col-sm-2"><img src="{{ asset($small_img) }}"
                                            class="img-thumbnail img-fluid img-responsive w-10"></div>
                                </div>
                            </div>
                            @php
                                if (!empty($state->state_image)) {
                                    $img = explode('.', $state->state_image);
                                    $small_img = $img[0] . '_thumb.' . $img[1];
                                } else {
                                    $small_img = '/upload/no_image.jpg'; # code...
                                }
                            @endphp
                            <div class="mt-3 col-sm-2"><img src="{{ asset($small_img) }}"
                                    class="img-thumbnail img-fluid img-responsive w-10"></div>
                        </div>
                        {!! Form::submit('Submit', ['class' => 'btn btn-outline-primary btn-icon-text mb-2 mb-md-0']) !!}
                        {{ Form::close() }}


                    </div>
                </div>
            </div>
        </div>

    </div>
    <script type="text/javascript">
        function mainThamUrl(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#mainThmb').attr('src', e.target.result).width(80).height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
