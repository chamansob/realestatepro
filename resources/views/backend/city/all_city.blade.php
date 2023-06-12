@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Cities</li>
                </li>
            </ol>
            <a href="{{ route('cities.create') }}" class="btn btn-inverse-info">Add City</a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">All Cities </h6>

                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Country Name</th>
                                        <th>State Name</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cities as $city)
                                        <tr>
                                            <td>{{ $city->id }}</td>
                                            <td>{{ $city->country() }}</td>
                                            <td>{{ !empty($city->state->name) ? $city->state->name : '-' }}</td>
                                            <td>{{ !empty($city->name) ? $city->name : '-' }}</td>

                                            <td>
                                                @if ($city->status == 0)
                                                    {!! Form::open([
                                                        'method' => 'patch',
                                                        'route' => ['cities.status', $city->id],
                                                        'class' => 'forms-sample',
                                                    ]) !!}
                                                    <button type="submit" class="btn badge rounded-pill bg-danger">InActive
                                                    </button>

                                                    {{ Form::close() }}
                                                @else
                                                    {!! Form::open([
                                                        'method' => 'patch',
                                                        'route' => ['cities.status', $city->id],
                                                        'class' => 'forms-sample',
                                                    ]) !!}

                                                    <button type="submit" class="btn badge rounded-pill bg-success">Active
                                                    </button>

                                                    {{ Form::close() }}
                                                @endif
                                            </td>

                                            <td>
                                                <form action="{{ route('cities.destroy', $city->id) }}" method="POST">

                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('cities.edit', $city->id) }}"
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
