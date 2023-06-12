@include('admin.body.main_header')
<!-- Session Status -->
<x-auth-session-status class="mb-4" :status="session('status')" />
<div class="page-wrapper full-page">
    <div class="page-content d-flex align-items-center justify-content-center">
        <div class="row w-100 mx-0 auth-page">
            <div class="col-md-8 col-xl-6 mx-auto">
                <div class="card">
                    <div class="row">
                        <div class="col-md-4 pe-md-0">
                            <div class="auth-side-wrapper">

                            </div>
                        </div>
                        <div class="col-md-8 ps-md-0">
                            <div class="auth-form-wrapper px-4 py-5">
                                <a href="#"
                                    class="noble-ui-logo logo-light d-block mb-2">Easy<span>Learning</span></a>
                                <h5 class="text-muted fw-normal mb-4">Welcome back! Log in to your account.</h5>
                                <form method="POST" class="forms-sample" action="{{ route('login') }}"
                                    autocomplete="off">
                                    @csrf
                                    <div class="mb-3">
                                        <x-input-label for="login" :value="__('Email/Name/Phone')" />
                                        <x-text-input id="email" class="form-control" type="text" name="login"
                                            :value="old('login')" required autofocus />
                                    </div>
                                    <div class="mb-3">
                                        <x-input-label for="password" :value="__('Password')" />

                                        <x-text-input id="password" class="form-control" type="password"
                                            name="password" required autocomplete="current-password" />
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>
                                    <div class="form-check mb-3">
                                        <input type="checkbox" class="form-check-input" id="authCheck">
                                        <input id="remember_me" type="checkbox" class="form-check-input"
                                            name="remember">
                                        <x-input-label class="form-check-label" for="authCheck" :value="__('Remember me')" />

                                    </div>
                                    <div>
                                        <x-primary-button class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">
                                            {{ __('Log in') }}
                                        </x-primary-button>
                                    </div>
                                    <a href="{{ route('password.request') }}" class="d-block mt-3 text-muted">Forgot
                                        your password?</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@include('admin.body.main_footer')
