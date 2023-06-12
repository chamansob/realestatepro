@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Image Preset All</li>
                </li>
            </ol>
            <a href="{{ route('image_preset.create') }}" class="btn btn-inverse-info">Add Image Preset</a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">All image_preset </h6>

                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Width</th>
                                        <th>Height</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($image_preset as $img)
                                        <tr>
                                            <td>{{ $img->id }}</td>
                                            <td>{{ ucfirst($img->name) }}</td>
                                            <td>{{ $img->width }}</td>
                                            <td>{{ $img->height }}</td>
                                            <td><a href="{{ route('image_preset.status', $img->id) }}"><span
                                                        class="badge rounded-pill bg-{{ $img->status == 0 ? 'success' : 'danger' }}">{{ $img->status == 0 ? 'Active' : 'Deactive' }}</span></a>
                                            </td>
                                            <td>
                                                <form action="{{ route('image_preset.destroy', $img->id) }}" method="POST">

                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('image_preset.edit', $img->id) }}"
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
