@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Property Type All</li>
                </li>
            </ol>
            <a href="{{ route('property_types.index') }}" class="btn btn-inverse-info">Show All Type Property</a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Add Property Type</h6>

                        <form method="POST" class="forms-sample" action="{{ route('property_types.store') }}"
                            autocomplete="off" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <x-input-label for="type_name" :value="__('Property Type Name')" />
                                <input id="type_name" type="text" name="type_name"
                                    class="form-control 
                                    @error('type_name') is-invalid @enderror "
                                    autofocus autocomplete="off" />
                                @error('type_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <x-input-label for="type_icon" :value="__('Property Type Icon')" />
                                <input id="type_icon" class="form-control @error('type_icon') is-invalid @enderror"
                                    type="text" name="type_icon" autofocus autocomplete="off" />
                                @error('type_icon')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <x-primary-button class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">
                                {{ __('Submit') }}
                            </x-primary-button>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
