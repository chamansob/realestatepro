<section class="sidebar-page-container blog-details sec-pad-2">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                <div class="blog-sidebar">
                    @include('frontend.dashboard.profile_info')
                    @include('frontend.dashboard.sidebar')
                </div>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                <div class="blog-details-content">
                    <div class="news-block-one">
                        <div class="inner-box">
                            <div class="lower-content">
                                <form method="POST" class="default-form" action="{{ route('user.profile.store') }}"
                                    autocomplete="off" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">

                                        <img class="wd-70 rounded-circle" id="showImage"
                                            src="{{ !empty($profileData->photo) ? asset($profileData->photo) : url('upload/no_image.jpg') }}"
                                            alt="profile">
                                    </div>
                                    <div class="form-group">
                                        <x-input-label for="photo" :value="__('Photo')" />
                                        <x-text-input id="photo" class="form-control" type="file" name="photo"
                                            id="image" />
                                    </div>
                                    <div class="form-group">
                                        <x-input-label for="username" :value="__('Username')" />
                                        <x-text-input id="username" class="form-control" type="text" name="username"
                                            value="{{ $profileData->username != '' ? $profileData->username : '--' }}"
                                            required autofocus autocomplete="off" />
                                    </div>
                                    <div class="form-group">

                                        <x-input-label for="name" :value="__('Name')" />
                                        <x-text-input id="name" class="form-control" type="text" name="name"
                                            value="{{ $profileData->name != '' ? $profileData->name : '--' }}" required
                                            autofocus autocomplete="off" />

                                    </div>
                                    <div class="form-group">
                                        <x-input-label for="email" :value="__('Email')" />
                                        <x-text-input id="email" class="form-control" type="email" name="email"
                                            value="{{ $profileData->email != '' ? $profileData->email : '--' }}"
                                            required autofocus autocomplete="off" />
                                    </div>
                                    <div class="form-group">
                                        <x-input-label for="phone" :value="__('Phone')" />
                                        <x-text-input id="phone" class="form-control" type="text" name="phone"
                                            value="{{ $profileData->phone != '' ? $profileData->phone : '' }}" autofocus
                                            autocomplete="off" />
                                    </div>
                                    <div class="form-group message-btn">
                                        <x-input-label for="address" :value="__('Address')" />
                                        <x-textarea id="address" class="form-control" name="address"
                                            value="{{ $profileData->address != '' ? $profileData->address : '' }}"
                                            autofocus autocomplete="off" />
                                    </div>
                                    <x-primary-button class="theme-btn btn-one">
                                        {{ __('Save Chnages') }}
                                    </x-primary-button>

                                </form>



                            </div>
                        </div>
                    </div>
                </div>
                <div class="blog-details-content">
                    <div class="news-block-one">
                        <div class="inner-box">
                            <div class="lower-content">
                                <h3>Activity Logs</h3>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
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
