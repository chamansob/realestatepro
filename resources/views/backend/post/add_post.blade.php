@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Blog</li>
                </li>
            </ol>
            <a href="{{ route('blog.index') }}" class="btn btn-inverse-info">Show All Blog </a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Add Post</h6>
                        {{ Form::open(['route' => 'blog.store', 'class' => 'forms-sample', 'method' => 'post', 'files' => true]) }}
                        <div class="mb-3">
                            {!! Form::label('blogcat_id', 'Blog Category', ['class' => 'form-label']) !!}

                            {!! Form::Select('blogcat_id', $blog_cat, null, [
                                'class' => 'form-control',
                                'placeholder' => 'Select Blog Category',
                            ]) !!}

                        </div>
                        <div class="row">

                            <div class="mb-3">

                                {!! Form::label('post_image', 'Image', ['class' => 'form-label']) !!}

                                {!! Form::file('post_image', [
                                    'class' => 'form-control',
                                    'placeholder' => 'Main Thumbnail',
                                    'onchange' => 'mainThamUrl(this)',
                                ]) !!}

                                <img src="" id="mainThmb">

                            </div>

                        </div>
                        <div class="mb-3">

                            {!! Form::label('post_title', 'Post title', ['class' => 'form-label']) !!}

                            {!! Form::text('post_title', $value = null, ['class' => 'form-control', 'placeholder' => 'Post title']) !!}
                            @error('post_title')
                                <span class="text-danger pt-3">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row">

                            <div class="mb-3">

                                {!! Form::label('short_descp', 'Short Description', ['class' => 'form-label']) !!}

                                {!! Form::textarea('short_descp', $value = null, [
                                    'class' => 'form-control',
                                    'rows' => 2,
                                    'placeholder' => 'Short Description',
                                ]) !!}
                                @error('short_descp')
                                    <span class="text-danger pt-3">{{ $message }}</span>
                                @enderror

                            </div>

                        </div>
                        <div class="row">

                            <div class="mb-3">

                                {!! Form::label('long_descp', 'Long Description', ['class' => 'form-label']) !!}

                                {!! Form::textarea('long_descp', $value = null, [
                                    'class' => 'form-control',
                                    'rows' => 2,
                                    'id' => 'tinymceExample',
                                    'placeholder' => 'Long Description',
                                ]) !!}
                                @error('long_descp')
                                    <span class="text-danger pt-3">{{ $message }}</span>
                                @enderror

                            </div>

                        </div>

                        <div class="row">

                            <div class="mb-3">
                                {!! Form::label('post_tags', 'Post Tags', ['class' => 'form-label']) !!}
                                {!! Form::select('post_tags[]', $value = $post_tags, null, [
                                    'class' => 'form-control js-example-basic-multiple',
                                    'multiple' => true,
                                ]) !!}



                            </div><!-- Col -->
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
