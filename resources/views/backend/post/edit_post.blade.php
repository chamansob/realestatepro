@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Blog </li>
                </li>
            </ol>
            <a href="{{ route('blog.index') }}" class="btn btn-inverse-info">Show All Blog </a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Edit Blog </h6>
                        {!! Form::open([
                            'method' => 'put',
                            'route' => ['blog.update', $blog->id],
                            'class' => 'forms-sample',
                            'files' => true,
                        ]) !!}
                        <div class="mb-3">
                            {!! Form::label('blogcat_id', 'Blog Category', ['class' => 'form-label']) !!}

                            {!! Form::Select('blogcat_id', $blog_cat, $blog->blogcat_id, [
                                'class' => 'form-control',
                                'placeholder' => 'Select Blog Category',
                            ]) !!}

                        </div>
                        <div class="row">
                            <div class="col-sm-10">
                                <div class="mb-3">

                                    {!! Form::label('post_image', 'Image', ['class' => 'form-label']) !!}

                                    {!! Form::file('post_image', [
                                        'class' => 'form-control',
                                        'placeholder' => 'Main Thumbnail',
                                        'onchange' => 'mainThamUrl(this)',
                                    ]) !!}
                                    @error('post_image')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                    <div class="mt-3"><img src="" id="mainThmb"
                                            class="img-responsive border border-1">
                                    </div>
                                </div>
                            </div>
                            <?php
                            $img = explode('.', $blog->post_image);
                            $small_img = $img[0] . '_thumb.' . $img[1];
                            ?>
                            <div class="mt-3 col-sm-2"><img src="{{ asset($small_img) }}"
                                    class="img-thumbnail img-fluid img-responsive w-10"></div>

                        </div>

                        <div class="mb-3">

                            {!! Form::label('post_title', 'Post title', ['class' => 'form-label']) !!}

                            {!! Form::text('post_title', $value = $blog->post_title, [
                                'class' => 'form-control',
                                'placeholder' => 'Post title',
                            ]) !!}
                            @error('post_title')
                                <span class="text-danger pt-3">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row">

                            <div class="mb-3">

                                {!! Form::label('short_descp', 'Short Description', ['class' => 'form-label']) !!}

                                {!! Form::textarea('short_descp', $value = $blog->short_descp, [
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

                                {!! Form::textarea('long_descp', $value = $blog->long_descp, [
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
                                {!! Form::select('post_tags[]', $value = $post_tags, explode(',', $blog->post_tags), [
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
