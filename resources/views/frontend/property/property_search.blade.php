@extends('frontend.frontend_dashboard')
@section('main')
    <!--Page Title-->
    <x-page-title :name="__('Property Search')" :bread="__('Property Search')" />
    <!--End Page Title-->
    <!-- property-page-section -->
    <section class="property-page-section property-list">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                    <!-- sidebar-section -->
                    @include('frontend.property.common.sidebar')
                    <!-- sidebar-section end -->
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                    <div class="property-content-side">
                        <div class="item-shorting clearfix">
                            <div class="left-column pull-left">
                                <h5>Search Reasults: <span>Showing {{ count($property) }} Listings</span></h5>
                            </div>
                            <div class="right-column pull-right clearfix">


                            </div>
                        </div>
                        <div class="wrapper list">
                            <div class="deals-list-content list-item">



                                @foreach ($property as $item)
                                    <div class="deals-block-one">
                                        <div class="inner-box">
                                            <div class="image-box">
                                                <figure class="image"><img src="{{ asset($item->property_thumbnail) }}"
                                                        alt="" style="width:300px; height:350px;"></figure>
                                                <div class="batch"><i class="icon-11"></i></div>
                                                @if ($item->featured == 1)
                                                    <span class="category">Featured</span>
                                                @else
                                                    <span class="category">New</span>
                                                @endif


                                                <div class="buy-btn"><a href="property-details.html">For
                                                        {{ $item->property_status }}</a></div>
                                            </div>
                                            <div class="lower-content">
                                                <div class="title-text">
                                                    <h4><a
                                                            href="{{ url('property/details/' . $item->id . '/' . $item->property_slug) }}">{{ $item->property_name }}</a>
                                                    </h4>
                                                </div>
                                                <div class="price-box clearfix">
                                                    <div class="price-info pull-left">
                                                        <h6>Start From</h6>
                                                        <h4>${{ number_format($item->lowest_price, 2) }}</h4>
                                                    </div>

                                                    @if ($item->agent_id == null)
                                                        <div class="author-box pull-right">
                                                            <figure class="author-thumb">
                                                                <img src="{{ url('upload/ariyan.jpg') }}" alt="">
                                                                <span>Admin</span>
                                                            </figure>
                                                        </div>
                                                    @else
                                                        <div class="author-box pull-right">
                                                            <figure class="author-thumb">
                                                                <img src="{{ !empty($item->user->photo) ? url('upload/agent_images/' . $item->user->photo) : url('upload/no_image.jpg') }}"
                                                                    alt="">
                                                                <span>{{ $item->user->name }}</span>
                                                            </figure>
                                                        </div>
                                                    @endif
                                                </div>
                                                <p>{{ $item->short_descp }}</p>
                                                <ul class="more-details clearfix">
                                                    <li><i class="icon-14"></i>{{ $item->bedrooms }} Beds</li>
                                                    <li><i class="icon-15"></i>{{ $item->bathrooms }} Baths</li>
                                                    <li><i class="icon-16"></i>{{ $item->property_size }} Sq Ft</li>
                                                </ul>
                                                <div class="other-info-box clearfix">
                                                    <div class="btn-box pull-left"><a
                                                            href="{{ url('property/details/' . $item->id . '/' . $item->property_slug) }}"
                                                            class="theme-btn btn-two">See Details</a></div>
                                                    <ul class="other-option pull-right clearfix">
                                                        <li><a aria-label="Compare" class="action-btn"
                                                                id="{{ $item->id }}" onclick="addToCompare(this.id)"><i
                                                                    class="icon-12"></i></a></li>

                                                        <li><a aria-label="Add To Wishlist" class="action-btn"
                                                                id="{{ $item->id }}"
                                                                onclick="addToWishList(this.id)"><i class="icon-13"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach




                            </div>

                        </div>
                        {{-- <div class="pagination-wrapper">
                            {{ $property->links('vendor.pagination.custom') }}
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- property-page-section end -->
    <!-- property-page-section end -->
    <!-- subscribe-section -->
    @include('frontend.home.subscribe')
    <!-- subscribe-section end -->
@endsection
