@extends('frontend.frontend_dashboard')
@section('main')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <x-page-title :name="__('Property Details')" :bread="__('Property Details')" />


    <!-- property-details -->
    <section class="property-details property-details-one">
        <div class="auto-container">
            <div class="top-details clearfix">
                <div class="left-column pull-left clearfix">

                    <h3>{{ $property->property_name }}</h3>
                    <div class="author-info clearfix">
                        <div class="author-box pull-left">

                            @if ($property->agent_id == null)
                                <figure class="author-thumb"><img
                                        src="{{ !empty($admin->photo) ? url($admin->photo) : url('upload/no_image.jpg') }}"
                                        alt=""></figure>
                                <h6>Admin</h6>
                            @else
                                <figure class="author-thumb"><img
                                        src="{{ !empty($property->user->photo) ? url($property->user->photo) : url('upload/no_image.jpg') }}"
                                        alt=""></figure>
                                <h6>{{ $property->user->name }}</h6>
                            @endif



                        </div>
                        <ul class="rating clearfix pull-left">
                            <li><i class="icon-39"></i></li>
                            <li><i class="icon-39"></i></li>
                            <li><i class="icon-39"></i></li>
                            <li><i class="icon-39"></i></li>
                            <li><i class="icon-40"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="right-column pull-right clearfix">
                    <div class="price-inner clearfix">
                        <ul class="category clearfix pull-left">
                            <li><a href="#">{{ $property->type->type_name }}</a></li>
                            <li><a href="#">For {{ $property->property_status }}</a></li>
                        </ul>
                        <div class="price-box pull-right">
                            <h3>${{ number_format($property->lowest_price, 2) }}.00</h3>
                        </div>
                    </div>
                    <ul class="other-option pull-right clearfix">
                        <li><a href="#"><i class="icon-37"></i></a></li>
                        <li><a href="#"><i class="icon-38"></i></a></li>
                        <li><a href="#"><i class="icon-12"></i></a></li>
                        <li><a href="javascript:void(0)" aria-label="Add To Wishlist"
                                class="action-btn {{ $property->wishlist($property->id) != 0 ? 'active' : '' }} pro_{{ $property->id }}"
                                id="{{ $property->id }}" onclick="addToWishList(this.id)"><i class="icon-13"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                    <div class="property-details-content">
                        <div class="carousel-inner">
                            <div class="single-item-carousel owl-carousel owl-theme owl-dots-none">
                                @foreach ($multiImage as $img)
                                    <figure class="image-box"><img src="{{ asset($img->photo_name) }}" alt="">
                                    </figure>
                                @endforeach
                            </div>
                        </div>
                        <div class="discription-box content-widget">
                            <div class="title-box">
                                <h4>Property Description</h4>
                            </div>
                            <div class="text">
                                {!! $property->long_descp !!}
                            </div>
                        </div>
                        <div class="details-box content-widget">
                            <div class="title-box">
                                <h4>Property Details</h4>
                            </div>
                            <ul class="list clearfix">
                                <li>Property ID: <span>{{ $property->property_code }}</span></li>
                                <li>Rooms: <span>{{ $property->bedrooms }}</span></li>
                                <li>Garage Size: <span>{{ $property->garage_size }} Sq Ft</span></li>

                                <li>Property Type: <span>{{ $property->type->type_name }}</span></li>
                                <li>Bathrooms: <span>{{ $property->bathrooms }}</span></li>
                                <li>Property Status: <span>For {{ $property->property_status }}</span></li>
                                <li>Property Size: <span>{{ $property->property_size }} Sq Ft</span></li>
                                <li>Garage: <span>{{ $property->garage }}</span></li>
                            </ul>
                        </div>
                        <div class="amenities-box content-widget">
                            <div class="title-box">
                                <h4>Amenities</h4>
                            </div>
                            <ul class="list clearfix">
                                @foreach ($property_amen as $amen)
                                    <li>{{ $amen->amenities_name }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="location-box content-widget">
                            <div class="title-box">
                                <h4>Location</h4>
                            </div>
                            <ul class="info clearfix">
                                <li><span>Address:</span> {{ $property->address }}</li>
                                <li><span>State/county:</span> {{ $property->state->name }}</li>
                                <li><span>Neighborhood:</span> {{ $property->neighborhood }}</li>
                                <li><span>Zip/Postal Code:</span> {{ $property->postal_code }}</li>
                                <li><span>City:</span> {{ $property->city->name }}</li>
                            </ul>
                            <div class="google-map-area">
                                <div class="google-map" id="contact-google-map" data-map-lat="{{ $property->latitude }}"
                                    data-map-lng="{{ $property->longitude }}"
                                    data-icon-path="{{ asset('frontend/assets/images/icons/map-marker.png') }}"
                                    data-map-title="Brooklyn, New York, United Kingdom" data-map-zoom="12"
                                    data-markers='{
            "marker-1": [40.712776, -74.005974, "<h4>Branch Office</h4><p>77/99 New York</p>","{{ asset('frontend/assets/images/icons/map-marker.png') }}"]
        }'>

                                </div>
                            </div>
                        </div>
                        <div class="nearby-box content-widget">
                            <div class="title-box">
                                <h4>What’s Nearby?</h4>
                            </div>
                            <div class="inner-box">
                                <div class="single-item">
                                    <div class="icon-box"><i class="fas fa-book-reader"></i></div>
                                    <div class="inner">
                                        <h5>Places:</h5>
                                        @foreach ($facility as $item)
                                            <div class="box clearfix">
                                                <div class="text pull-left">
                                                    <h6>{{ $item->facility_name }} <span>({{ $item->distance }} km)</span>
                                                    </h6>
                                                </div>
                                                <ul class="rating pull-right clearfix">
                                                    <li><i class="icon-39"></i></li>
                                                    <li><i class="icon-39"></i></li>
                                                    <li><i class="icon-39"></i></li>
                                                    <li><i class="icon-39"></i></li>
                                                    <li><i class="icon-40"></i></li>
                                                </ul>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="statistics-box content-widget">
                            <div class="title-box">
                                <h4>Property Vide</h4>
                            </div>
                            <figure class="image-box">
                                <iframe width="100%" height="360" src="{{ $property->property_video }}"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen></iframe>
                        </div>
                        <div class="schedule-box content-widget">
                            <div class="title-box">
                                <h4>Schedule A Tour</h4>
                            </div>
                            <div class="form-inner">
                                <form action="#" method="post">
                                    <div class="row clearfix">
                                        <div class="col-lg-6 col-md-12 col-sm-12 column">
                                            <div class="form-group">
                                                <i class="far fa-calendar-alt"></i>
                                                <input type="text" name="date" placeholder="Tour Date"
                                                    id="datepicker">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 column">
                                            <div class="form-group">
                                                <i class="far fa-clock"></i>
                                                <input type="text" name="time" placeholder="Any Time">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12 col-sm-12 column">
                                            <div class="form-group">
                                                <input type="text" name="name" placeholder="Your Name"
                                                    required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12 col-sm-12 column">
                                            <div class="form-group">
                                                <input type="email" name="email" placeholder="Your Email"
                                                    required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12 col-sm-12 column">
                                            <div class="form-group">
                                                <input type="tel" name="phone" placeholder="Your Phone"
                                                    required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 column">
                                            <div class="form-group">
                                                <textarea name="message" placeholder="Your message"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 column">
                                            <div class="form-group message-btn">
                                                <button type="submit" class="theme-btn btn-one">Submit Now</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                    <div class="property-sidebar default-sidebar">
                        <div class="author-widget sidebar-widget">
                            <div class="author-box">
                                @if ($property->agent_id == null)
                                    <figure class="author-thumb"><img
                                            src="{{ !empty($admin->photo) ? url($admin->photo) : url('upload/no_image.jpg') }}"
                                            alt=""></figure>
                                    <div class="inner">
                                        <h4>Admin </h4>
                                        <ul class="info clearfix">
                                            <li><i class="fas fa-map-marker-alt"></i>{{ $admin->address }}</li>
                                            <li><i class="fas fa-phone"></i><a
                                                    href="tel:03030571965">{{ $admin->phone }}</a></li>
                                        </ul>
                                        <div class="btn-box"><a href="#">View Listing</a></div>
                                    </div>
                                @else
                                    <figure class="author-thumb"><img
                                            src="{{ !empty($property->user->photo) ? url($property->user->photo) : url('upload/no_image.jpg') }}"
                                            alt=""></figure>
                                    <div class="inner">
                                        <h4>{{ $property->user->name }}</h4>
                                        <ul class="info clearfix">
                                            <li><i class="fas fa-map-marker-alt"></i>{{ $property->user->address }}</li>
                                            <li><i class="fas fa-phone"></i><a
                                                    href="tel:03030571965">{{ $property->user->phone }}</a></li>
                                        </ul>
                                        <div class="btn-box"><a href="agents-details.html">View Listing</a></div>
                                    </div>
                                @endif
                            </div>
                            <div class="form-inner">
                                <form action="#" method="post" class="default-form">
                                    <div class="form-group">
                                        <input type="text" name="name" placeholder="Your name" required="">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" placeholder="Your Email" required="">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="phone" placeholder="Phone" required="">
                                    </div>
                                    <div class="form-group">
                                        <textarea name="message" placeholder="Message"></textarea>
                                    </div>
                                    <div class="form-group message-btn">
                                        <button type="submit" class="theme-btn btn-one">Send Message</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="calculator-widget sidebar-widget">
                            <div class="calculate-inner">
                                <div class="widget-title">
                                    <h4>Mortgage Calculator</h4>
                                </div>
                                <form method="post" action="mortgage-calculator.html" class="default-form">
                                    <div class="form-group">
                                        <i class="fas fa-dollar-sign"></i>
                                        <input type="number" name="total_amount" placeholder="Total Amount">
                                    </div>
                                    <div class="form-group">
                                        <i class="fas fa-dollar-sign"></i>
                                        <input type="number" name="down_payment" placeholder="Down Payment">
                                    </div>
                                    <div class="form-group">
                                        <i class="fas fa-percent"></i>
                                        <input type="number" name="interest_rate" placeholder="Interest Rate">
                                    </div>
                                    <div class="form-group">
                                        <i class="far fa-calendar-alt"></i>
                                        <input type="number" name="loan" placeholder="Loan Terms(Years)">
                                    </div>
                                    <div class="form-group">
                                        <div class="select-box">
                                            <select class="wide">
                                                <option data-display="Monthly">Monthly</option>
                                                <option value="1">Yearly</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group message-btn">
                                        <button type="submit" class="theme-btn btn-one">Calculate Now</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="similar-content">
                <div class="title">
                    <h4>Similar Properties</h4>
                </div>
                <div class="row clearfix">
                    @foreach ($property_related as $property)
                        <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                            <div class="feature-block-one wow fadeInUp animated" data-wow-delay="600ms"
                                data-wow-duration="1500ms">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image"><img src="{{ asset($property->property_thumbnail) }}"
                                                alt="">
                                        </figure>
                                        <div class="batch"><i class="icon-11"></i></div>
                                        <span class="category">Featured</span>
                                    </div>
                                    <div class="lower-content">
                                        <div class="author-info clearfix">
                                            <div class="author pull-left">
                                                <figure class="author-thumb"><img
                                                        src="{{ !empty($property->user->photo) ? asset($property->user->photo) : url('upload/no_image.jpg') }}"
                                                        alt=""></figure>
                                                <h6>{{ isset($property->user->name) ? $property->user->name : 'Admin' }}
                                                </h6>
                                            </div>
                                            <div class="buy-btn pull-right"><a href="#">for
                                                    {{ ucfirst($property->property_status) }}</a>
                                            </div>
                                        </div>
                                        <div class="title-text">
                                            <h4><a
                                                    href="{{ url('property/details/' . $property->id . '/' . $property->property_slug) }}">{{ ucfirst($property->property_name) }}</a>
                                            </h4>
                                        </div>
                                        <div class="price-box clearfix">
                                            <div class="price-info pull-left">
                                                <h6>Start From</h6>
                                                <h4>${{ number_format($property->lowest_price, 2) }}</h4>
                                            </div>
                                            <ul class="other-option pull-right clearfix">
                                                <li><a href="#"><i class="icon-12"></i></a></li>
                                                <li><a href="#"><i class="icon-13"></i></a></li>
                                            </ul>
                                        </div>
                                        <p>{{ $property->short_descp }}</p>
                                        <ul class="more-details clearfix">
                                            <li><i class="icon-14"></i>{{ $property->bedrooms }} Beds</li>
                                            <li><i class="icon-15"></i>{{ $property->bathrooms }} Baths</li>
                                            <li><i class="icon-16"></i>{{ $property->property_size }} Sq Ft</li>
                                        </ul>
                                        <div class="btn-box"><a
                                                href="{{ url('property/details/' . $property->id . '/' . $property->property_slug) }}"
                                                class="theme-btn btn-two">See
                                                Details</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- property-details end -->

    <!-- subscribe-section -->
    @include('frontend.home.subscribe')
    <!-- subscribe-section end -->
@endsection
