@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Property Type</li>
                </li>
            </ol>
            <a href="{{ route('amenities.index') }}" class="btn btn-inverse-info">Show All Amenities</a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Edit Amenities</h6>

                        <form method="POST" class="forms-sample" action="{{ route('amenities.update', $amenity->id) }}"
                            autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <x-input-label for="type_name" :value="__('Amenities Name')" />
                                <input id="amenities_name" type="text" name="amenities_name"
                                    class="form-control 
                                    @error('amenities_name') is-invalid @enderror "
                                    autofocus autocomplete="off" value="{{ $amenity->amenities_name }}" />
                                @error('amenities_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <x-primary-button class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">
                                {{ __('Save Changes') }}
                            </x-primary-button>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
