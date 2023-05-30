  <section class="ragister-section centred sec-pad">
      <div class="auto-container">
          <div class="row clearfix">
              <div class="col-xl-8 col-lg-12 col-md-12 offset-xl-2 big-column">
                  <div class="sec-title">
                      <h5>Sign in</h5>
                      <h2>Sign In With Realshed</h2>
                  </div>
                  <div class="tabs-box">
                      <div class="tab-btn-box">
                          <ul class="tab-btns tab-buttons centred clearfix">
                              <li class="tab-btn active-btn" data-tab="#tab-1">Login</li>
                              <li class="tab-btn" data-tab="#tab-2">Register</li>
                          </ul>
                      </div>
                      <div class="tabs-content">
                          <div class="tab active-tab" id="tab-1">
                              <div class="inner-box">
                                  <h4>Login</h4>

                                  <form method="POST" class="default-form" action="{{ route('login') }}"
                                      autocomplete="off">
                                      @csrf
                                      <div class="form-group">
                                          <x-input-label for="login" :value="__('Email/Name/Phone')" />
                                          <x-text-input id="email" class="form-control" type="text"
                                              name="login" :value="old('login')" required autofocus />

                                      </div>
                                      <div class="form-group">
                                          <x-input-label for="password" :value="__('Password')" />

                                          <x-text-input id="password" class="form-control" type="password"
                                              name="password" required autocomplete="current-password" />
                                          <x-input-error :messages="$errors->get('password')" class="mt-2" />

                                      </div>
                                      <div class="form-check mb-3 text-start">
                                          <input type="checkbox" class="form-check-input" id="authCheck">
                                          <input id="remember_me" type="checkbox" class="form-check-input"
                                              name="remember">
                                          <x-input-label class="form-check-label" for="authCheck" :value="__('Remember me')" />

                                      </div>
                                      <div class="form-group message-btn">
                                          <x-primary-button class="theme-btn btn-one">
                                              {{ __('Log in') }}
                                          </x-primary-button>
                                      </div>
                                  </form>

                              </div>
                          </div>
                          <div class="tab" id="tab-2">
                              <div class="inner-box">
                                  <h4>Register</h4>

                                  <form method="POST" class="default-form" action="{{ route('register') }}"
                                      autocomplete="off">
                                      @csrf
                                      <div class="form-group">

                                          <x-input-label for="name" :value="__('User Name')" />
                                          <x-text-input id="name" class="form-control" type="text"
                                              name="name" :value="old('name')" required autofocus autocomplete="name" />
                                          <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                      </div>
                                      <div class="form-group">

                                          <x-input-label for="email" :value="__('Email')" />
                                          <x-text-input id="email" class="form-control" type="email"
                                              name="email" :value="old('email')" required autocomplete="username" />
                                          <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                      </div>
                                      <!-- Password -->
                                      <div class="form-group">
                                          <x-input-label for="password" :value="__('Password')" />

                                          <x-text-input id="password" class="form-control" type="password"
                                              name="password" required autocomplete="new-password" />

                                          <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                      </div>

                                      <!-- Confirm Password -->
                                      <div class="form-group">
                                          <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                                          <x-text-input id="password_confirmation" class="form-control" type="password"
                                              name="password_confirmation" required autocomplete="new-password" />

                                          <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                      </div>


                                      <div class="form-group message-btn">
                                          <x-primary-button class="theme-btn btn-one">
                                              {{ __('Register') }}
                                          </x-primary-button>
                                      </div>
                                  </form>

                              </div>
                          </div>
                      </div>
                  </div>


              </div>
          </div>
      </div>
  </section>
