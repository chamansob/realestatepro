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
                                <form method="POST" class="default-form"action="{{ route('user.password.update') }}"
                                    autocomplete="off">
                                    @csrf

                                     <div class="form-group">
                                        <x-input-label for="old_password" :value="__('Old Password')" />

                                        <input type="password" name="old_password"
                                            class="form-control @error('old_password') is-invalid @enderror "
                                            id="old_password" autocomplete="off" />
                                        @error('old_password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <x-input-label for="new_password" :value="__('New Password')" />
                                        <input id="new_password"
                                            class="form-control @error('new_password') is-invalid @enderror" type="password"
                                            name="new_password" autocomplete="off" />
                                        @error('new_password')
                                            <span class="text-danger pt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                     <div class="form-group">
                                        <x-input-label for="new_password" :value="__('Confirm New Password')" />
                                        <input id="new_password_confirmation" class="form-control" type="password"
                                            name="new_password_confirmation" autocomplete="off" />

                                    </div>
                                    <x-primary-button class="theme-btn btn-one">
                                        {{ __('Update Password') }}
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
