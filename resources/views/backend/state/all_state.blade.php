@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">States All</li>
                </li>
            </ol>
            <a href="{{ route('states.create') }}" class="btn btn-inverse-info">Add States</a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">All States </h6>

                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Country Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($states as $state)
                                        <tr>
                                            <td>{{ $state->id }}</td>
                                            <td>{{ !empty($state->name) ? $state->name : '-' }}</td>
                                            <td>{{ !empty($state->country->name) ? $state->country->name : '-' }}</td>
                                            <td>

                                            <td>
                                                @if ($state->status == 0)
                                                    {!! Form::open([
                                                        'method' => 'patch',
                                                        'route' => ['states.status', $state->id],
                                                        'class' => 'forms-sample',
                                                    ]) !!}
                                                    <button type="submit" class="btn badge rounded-pill bg-danger">InActive
                                                    </button>

                                                    {{ Form::close() }}
                                                @else
                                                    {!! Form::open([
                                                        'method' => 'patch',
                                                        'route' => ['states.status', $state->id],
                                                        'class' => 'forms-sample',
                                                    ]) !!}

                                                    <button type="submit" class="btn badge rounded-pill bg-success">Active
                                                    </button>

                                                    {{ Form::close() }}
                                                @endif
                                            </td>
                                            </td>
                                            <td>
                                                <form action="{{ route('states.destroy', $state->id) }}" method="POST">

                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('states.edit', $state->id) }}"
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
