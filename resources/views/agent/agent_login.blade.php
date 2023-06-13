 @extends('frontend.frontend_dashboard')
 @section('main')
     <x-page-title :name="__('Sign In')" :bread="__('Sign In')" />

     <!-- Login- Register-section -->
     @include('agent.login.login_form')
     <!-- Login- Register-section end -->

     <!-- subscribe-section -->
     @include('frontend.home.subscribe')
     <!-- subscribe-section end -->
 @endsection
