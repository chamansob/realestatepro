@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Blog Category</li>
                </li>
            </ol>
            <a href="{{ route('blog_category.index') }}" class="btn btn-inverse-info">Show All Blog Category</a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Edit Blog Category</h6>
                        {!! Form::open([
                            'method' => 'put',
                            'route' => ['blog_category.update', $blog_category->id],
                            'class' => 'forms-sample',
                        ]) !!}
                        <div class="mb-3">

                            {!! Form::label('name', 'Country Name', ['class' => 'form-label']) !!}

                            {!! Form::text('category_name', $value = $blog_category->category_name, [
                                'class' => 'form-control',
                                'placeholder' => 'Category Name',
                            ]) !!}
                            @error('category_name')
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
