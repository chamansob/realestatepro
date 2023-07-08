@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Testimonials All</li>
                </li>
            </ol>
            <a href="{{ route('testimonials.create') }}" class="btn btn-inverse-info">Add Testimonials</a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">All testimonials </h6>

                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Posstion</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($testimonials as $testimonial)
                                        <tr>
                                            <td>{{ $testimonial->id }}</td>
                                            <td>@php
                                                if (!empty($testimonial->image)) {
                                                    $img = explode('.', $testimonial->image);
                                                    $small_img = $img[0] . '_small.' . $img[1];
                                                } else {
                                                    $small_img = '/upload/no_image.jpg'; # code...
                                                }
                                            @endphp
                                                <img src="{{ asset($small_img) }}"
                                                    class="img-thumbnail img-fluid img-responsive w-10">
                                            </td>
                                            <td>{{ !empty($testimonial->name) ? $testimonial->name : '-' }}</td>
                                            <td>{{ !empty($testimonial->position) ? $testimonial->position : '-' }}</td>


                                            <td>
                                                <form action="{{ route('testimonials.destroy', $testimonial->id) }}"
                                                    method="POST">

                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('testimonials.edit', $testimonial->id) }}"
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
