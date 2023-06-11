@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <div class="page-content">


        <div class="row profile-body">
            <!-- left wrapper start -->
            <div class="d-none d-md-block col-md-4 col-xl-4 left-wrapper">
                <div class="card rounded">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-2">

                            <div>
                                <img class="wd-100 rounded-circle"
                                    src="{{ !empty($profileData->photo) ? asset($profileData->photo) : url('upload/no_image.jpg') }}"
                                    alt="profile">
                                <span class="h4 ms-3 ">{{ $profileData->name != '' ? $profileData->name : '--' }}</span>
                            </div>
                        </div>

                        <div class="mt-3">
                            <label class="tx-11 fw-bolder mb-0 text-uppercase">Name:</label>
                            <p class="text-muted">{{ $profileData->name != '' ? $profileData->name : '--' }}</p>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 fw-bolder mb-0 text-uppercase">Address:</label>
                            <p class="text-muted">{{ $profileData->address != '' ? $profileData->address : '--' }}</p>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 fw-bolder mb-0 text-uppercase">Email:</label>
                            <p class="text-muted">{{ $profileData->email != '' ? $profileData->email : '--' }}</p>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 fw-bolder mb-0 text-uppercase">Phone:</label>
                            <p class="text-muted">{{ $profileData->phone != '' ? $profileData->phone : '--' }}</p>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 fw-bolder mb-0 text-uppercase">Created:</label>
                            <p class="text-muted">{{ $profileData->created_at != '' ? $profileData->created_at : '--' }}</p>
                        </div>
                        <div class="mt-3 d-flex social-links">
                            <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                                <i data-feather="github"></i>
                            </a>
                            <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                                <i data-feather="twitter"></i>
                            </a>
                            <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                                <i data-feather="instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- left wrapper end -->
            <!-- middle wrapper start -->
            <div class="col-md-8 col-xl-8 middle-wrapper">
                <div class="row">
                    <div class="col-md-12 grid-margin">
                        <div class="card">
                            <div class="card-body">

                                <h6 class="card-title">Update Admin Profile</h6>

                                <form method="POST" class="forms-sample" action="{{ route('admin.profile.store') }}"
                                    autocomplete="off" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <img class="wd-70 rounded-circle" id="showImage"
                                            src="{{ !empty($profileData->photo) ? asset($profileData->photo) : url('upload/no_image.jpg') }}"
                                            alt="profile">
                                    </div>
                                    <div class="mb-3">
                                        <x-input-label for="photo" :value="__('Photo')" />
                                        <x-text-input id="photo" class="form-control" type="file" name="photo"
                                            id="image" />
                                    </div>
                                    <div class="mb-3">
                                        <x-input-label for="username" :value="__('Username')" />
                                        <x-text-input id="username" class="form-control" type="text" name="username"
                                            value="{{ $profileData->username != '' ? $profileData->username : '--' }}"
                                            required autofocus autocomplete="off" />
                                    </div>
                                    <div class="mb-3">

                                        <x-input-label for="name" :value="__('Name')" />
                                        <x-text-input id="name" class="form-control" type="text" name="name"
                                            value="{{ $profileData->name != '' ? $profileData->name : '--' }}" required
                                            autofocus autocomplete="off" />

                                    </div>
                                    <div class="mb-3">
                                        <x-input-label for="email" :value="__('Email')" />
                                        <x-text-input id="email" class="form-control" type="email" name="email"
                                            value="{{ $profileData->email != '' ? $profileData->email : '--' }}" required
                                            autofocus autocomplete="off" />
                                    </div>
                                    <div class="mb-3">
                                        <x-input-label for="phone" :value="__('Phone')" />
                                        <x-text-input id="phone" class="form-control" type="text" name="phone"
                                            value="{{ $profileData->phone != '' ? $profileData->phone : '' }}" required
                                            autofocus autocomplete="off" />
                                    </div>
                                    <div class="mb-3">
                                        <x-input-label for="address" :value="__('Address')" />
                                        <x-textarea id="address" class="form-control" name="address"
                                            value="{{ $profileData->address != '' ? $profileData->address : '' }}" required
                                            autofocus autocomplete="off" />
                                    </div>
                                    <x-primary-button class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">
                                        {{ __('Save Chnages') }}
                                    </x-primary-button>

                                </form>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- middle wrapper end -->
            <!-- right wrapper start -->

            <!-- right wrapper end -->
        </div>

    </div>
    <script>
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
