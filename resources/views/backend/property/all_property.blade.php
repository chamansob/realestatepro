@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Property All</li>
                </li>
            </ol>
            <a href="{{ route('properties.create') }}" class="btn btn-inverse-info">Add Property</a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Property All</h6>

                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Status Type</th>
                                        <th>City</th>
                                        <th>Code</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($properties as $property)
                                        <?php
                                        $img = explode('.', $property->property_thumbnail);
                                        $table_img = $img[0] . '_small.' . $img[1]; ?>
                                        <tr>
                                            <td>{{ $property->id }}</td>
                                            <td><img src="{{ asset($table_img) }}"></td>
                                            <td>{{ ucfirst($property->property_name) }}</td>
                                            <td>{{ $property->type->type_name }}</td>
                                            <td>{{ ucfirst($property->property_status) }}</td>
                                            <td>{{ $property->city($property->city) }}</td>
                                            <td>{{ $property->property_code }}</td>
                                            <td>
                                                <a href="#"><span
                                                        class="badge rounded-pill bg-{{ !$property->status == 1 ? 'danger' : 'success' }}">{{ !$property->status == 1 ? 'Deactive' : 'Active' }}</span></a>
                                            </td>
                                            <td>
                                                <form action="{{ route('properties.destroy', $property->id) }}"
                                                    method="POST">

                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('properties.edit', $property->id) }}"
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
