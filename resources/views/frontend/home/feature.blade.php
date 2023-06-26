<section class="feature-section sec-pad bg-color-1">
    <div class="auto-container">
        <div class="sec-title centred">
            <h5>Features</h5>
            <h2>Featured Property</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing sed do eiusmod tempor incididunt <br />labore
                dolore magna aliqua enim.</p>
        </div>
        <div class="row clearfix">

            @php
                $properties = App\Models\Property::where('featured', 1)
                    ->where('status', 1)
                    ->limit(3)
                    ->get();
                
                // dd($property);
                
            @endphp
            @foreach ($properties as $property)
                <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                    <div class="feature-block-one wow fadeInUp animated" data-wow-delay="600ms" data-wow-duration="1500ms">
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
                                        <h6>{{ isset($property->user->name) ? $property->user->name : 'Admin' }}</h6>
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
                                        <li><a href="javascript:void(0)" aria-label="Add To Compare"
                                                class="action-btn {{ $property->compare($property->id) != 0 ? 'active' : '' }} proc_{{ $property->id }}"
                                                id="{{ $property->id }}" onclick="addToCompare(this.id)"><i
                                                    class="icon-12"></i></a></li>
                                        <li><a href="javascript:void(0)" aria-label="Add To Wishlist"
                                                class="action-btn {{ $property->wishlist($property->id) != 0 ? 'active' : '' }} pro_{{ $property->id }}"
                                                id="{{ $property->id }}" onclick="addToWishList(this.id)"><i
                                                    class="icon-13 pe-auto"></i></a>
                                        </li>
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
        <div class="more-btn centred"><a href="#" class="theme-btn btn-one">View All
                Listing</a></div>
    </div>
</section>
