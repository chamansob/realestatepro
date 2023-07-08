@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Testimonial</li>
                </li>
            </ol>
            <a href="{{ route('testimonials.index') }}" class="btn btn-inverse-info">Show All testimonials</a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Edit Testimonial</h6>
                        {!! Form::open([
                            'method' => 'put',
                            'route' => ['testimonials.update', $testimonial->id],
                            'class' => 'forms-sample',
                            'files' => true,
                        ]) !!}

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">

                                    {!! Form::label('name', 'Name', ['class' => 'form-label']) !!}

                                    {!! Form::text('name', $value = $testimonial->name, ['class' => 'form-control', 'placeholder' => 'Name']) !!}
                                    @error('name')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    {!! Form::label('position', 'Position', ['class' => 'form-label']) !!}

                                    {!! Form::text('position', $value = $testimonial->position, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Position',
                                    ]) !!}
                                    @error('position')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">

                            {!! Form::label('message', 'Message', ['class' => 'form-label']) !!}

                            {!! Form::textarea('message', $value = $testimonial->message, [
                                'class' => 'form-control',
                                'id' => 'tinymceExample',
                                'rows' => 2,
                                'placeholder' => 'Message',
                            ]) !!}
                            @error('message')
                                <span class="text-danger pt-3">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-sm-10">
                                <div class="mb-3">

                                    {!! Form::label('image', 'Image', ['class' => 'form-label']) !!}

                                    {!! Form::file('image', [
                                        'class' => 'form-control',
                                        'placeholder' => 'Image',
                                        'onchange' => 'mainThamUrl(this)',
                                    ]) !!}
                                    @error('image')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                    <div class="mt-3"><img src="" id="mainThmb"
                                            class="img-responsive border border-1">
                                    </div>
                                </div>
                            </div>
                            @php
                                if (!empty($testimonial->image)) {
                                    $img = explode('.', $testimonial->image);
                                    $small_img = $img[0] . '.' . $img[1];
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
