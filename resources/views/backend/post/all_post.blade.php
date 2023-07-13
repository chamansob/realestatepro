@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Post All</li>
                </li>
            </ol>
            <a href="{{ route('blog.create') }}" class="btn btn-inverse-info">Add Post </a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">All Post </h6>

                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Post Title</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($blog as $post)
                                        <tr>
                                            <td>{{ $post->id }}</td>
                                            <td>@php
                                                if (!empty($post->post_image)) {
                                                    $img = explode('.', $post->post_image);
                                                    $small_img = $img[0] . '_thumb.' . $img[1];
                                                } else {
                                                    $small_img = '/upload/no_image.jpg'; # code...
                                                }
                                            @endphp
                                                <img src="{{ asset($small_img) }}"
                                                    class="img-thumbnail img-fluid img-responsive w-10">
                                            </td>
                                            <td>{{ $post->post_title }}</td>
                                            <td>{{ $post->created_at->format('l d M Y') }}</td>

                                            <td>
                                                <form action="{{ route('blog.destroy', $post->id) }}" method="POST">

                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('blog.edit', $post->id) }}"
                                                        class="btn btn-inverse-warning">Edit</a>
                                                    <button type="submit"
                                                        class="btn btn-inverse-danger btn-submit">Delete</button>
                                                </form>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
