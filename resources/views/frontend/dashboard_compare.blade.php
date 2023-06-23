@extends('frontend.frontend_dashboard')
@section('main')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <x-page-title :name="__('Compare History')" :bread="__('Compare History')" />

    <!-- Login- Register-section -->
    @include('frontend.dashboard.compare')
    <!-- Login- Register-section end -->

    <!-- subscribe-section -->
    @include('frontend.home.subscribe')
    <!-- subscribe-section end -->
@endsection
