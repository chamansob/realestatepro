@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Agents</li>
                </li>
            </ol>
            <a href="{{ route('admin.agent_add') }}" class="btn btn-inverse-info">Add Agent</a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">All Agents </h6>

                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Change</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($agents as $agent)
                                        <tr>
                                            <td>{{ $agent->id }}</td>
                                            <td><img class="wd-100 rounded-circle"
                                                    src="{{ !empty($agent->photo) || file_exists(asset($agent->photo)) ? asset($agent->photo) : url('upload/no_image.jpg') }}"
                                                    alt="profile"></td>
                                            <td>{{ ucfirst($agent->name) }}</td>
                                            <td>{{ ucfirst($agent->role) }}</td>
                                            <td> <a href="#" id="currentStatus{{ $agent->id }}"><span
                                                        class="badge rounded-pill bg-{{ $agent->status == 1 ? 'danger' : 'success' }}">{{ $agent->status == 1 ? 'Deactive' : 'Active' }}</span></a>
                                            </td>
                                            <td>
                                                <input data-id="{{ $agent->id }}" class="toggle-class" type="checkbox"
                                                    data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                    data-on="Active" data-off="Inactive"
                                                    {{ $agent->status == 0 ? 'checked' : '' }}>

                                            </td>

                                            <td>
                                                <form action="{{ route('admin.agent_delete', $agent->id) }}"
                                                    method="POST">

                                                    @csrf
                                                    @method('DELETE')

                                                    <a href="{{ route('admin.agent_edit', $agent->id) }}"
                                                        class="btn btn-inverse-warning"><i data-feather="edit"></i> </a>

                                                    <button type="submit" class="btn btn-inverse-danger btn-submit"><i
                                                            data-feather="trash-2"></i> </button>
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
    <script type="text/javascript">
        $(function() {
            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var user_id = $(this).data('id');
                var crf = '{{ csrf_token() }}';
                $.ajax({
                    type: "PUT",
                    dataType: "json",
                    url: '{{ route('admin.agent_status') }}',
                    data: {
                        _token: crf,
                        'status': status,
                        'user_id': user_id
                    },
                    success: function(data) {
                        console.log('#currentStatus' + user_id)
                        if (status == 1) {
                            $('#currentStatus' + user_id).html('')
                            $('#currentStatus' + user_id).html(
                                '<span class="badge rounded-pill bg-success">Active</span>'
                            )

                        }
                        if (status == 0) {
                            $('#currentStatus' + user_id).html('')
                            $('#currentStatus' + user_id).html(
                                '<span class="badge rounded-pill bg-danger">Deactive</span>'
                            )
                        }

                        //console.log(data.success)
                        // Start Message 
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        if ($.isEmptyObject(data.error)) {

                            Toast.fire({
                                type: 'success',
                                title: data.success,
                            })
                        } else {

                            Toast.fire({
                                type: 'error',
                                title: data.error,
                            })
                        }
                        // End Message   
                    }
                });
            })
        })
    </script>
@endsection
