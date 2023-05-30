@extends('frontend.frontend_dashboard')
@section('main')
    <x-page-title :name="__('My Profile')" :bread="__('My Profile')" />

    <!-- Login- Register-section -->
    @include('frontend.dashboard.profile_section')
    <!-- Login- Register-section end -->

    <!-- subscribe-section -->
    @include('frontend.home.subscribe')
    <!-- subscribe-section end -->
@endsection
