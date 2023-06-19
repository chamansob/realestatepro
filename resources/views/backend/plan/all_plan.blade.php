@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Property plan All</li>
                </li>
            </ol>
            <a href="{{ route('plan.create') }}" class="btn btn-inverse-info">Add Plan</a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">All Plans</h6>

                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Icon</th>
                                        <th>Heading</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($plans as $plan)
                                        <tr>
                                            <td>{{ $plan->id }}</td>
                                            <td>{{ ucfirst($plan->plan_name) }}</td>
                                            <td><i data-feather="{{ $plan->plan_icon }}"
                                                    class="icon-md text-success me-2"></i></td>

                                            <td>{{ $plan->plan_heading }}</td>
                                            <td>{{ $plan->plan_amount }}</td>
                                            <td>
                                                <form action="{{ route('plan.destroy', $plan->id) }}" method="POST">

                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('plan.edit', $plan->id) }}"
                                                        class="btn btn-inverse-warning">Edit</a>
                                                    <button plan="submit"
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
