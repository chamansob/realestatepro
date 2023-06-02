@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Property Type All</li>
                </li>
            </ol>
            <a href="{{ route('property_types.create') }}" class="btn btn-inverse-info">Add Property Type</a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Property Type All</h6>

                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Type Name</th>
                                        <th>Type Icon</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($types as $type)
                                        <tr>
                                            <td>{{ $type->id }}</td>
                                            <td>{{ $type->type_name }}</td>
                                            <td>{{ $type->type_icon }}</td>
                                            <td>
                                                <form action="{{ route('property_types.destroy', $type->id) }}"
                                                    method="POST">

                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('property_types.edit', $type->id) }}"
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
