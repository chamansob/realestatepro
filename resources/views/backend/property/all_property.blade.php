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
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($properties as $property)
                                        <tr>
                                            <td>{{ $property->id }}</td>
                                            <td><img src="{{ asset($property->photo) }}"></td>
                                            <td>{{ $property->property_name }}</td>
                                            <td>{{ $property->property_type }}</td>
                                            <td>{{ $property->property_status }}</td>
                                            <td>{{ $property->city }}</td>
                                            <td>{{ $property->status }}</td>
                                            <td>
                                                <form action="{{ route('property_types.destroy', $property->id) }}"
                                                    method="POST">

                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('property_types.edit', $property->id) }}"
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
