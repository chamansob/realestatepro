<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <title>Easy - RealState </title>

    <!-- Fav Icon -->
    <link rel="icon" href="{{ asset('frontend/assets/images/favicon.ico') }}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Stylesheets -->
    <link href="{{ asset('frontend/assets/css/font-awesome-all.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/flaticon.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/owl.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/jquery.fancybox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/nice-select.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/color/theme-color.css') }}" id="jssDefault" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/switcher-style.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/responsive.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

</head>


<!-- page wrapper -->

<body>

    <div class="boxed_wrapper">


        <!-- preloader -->
        @include('frontend.home.preload')
        <!-- preloader end -->


        <!-- switcher menu -->

        <!-- end switcher menu -->


        <!-- main header -->
        @include('frontend.home.header')
        <!-- main-header end -->

        <!-- Mobile Menu  -->
        @include('frontend.home.mobile_menu')
        <!-- End Mobile Menu -->


        @yield('main')


        <!-- main-footer -->
        @include('frontend.home.footer')
        <!-- main-footer end -->



        <!--Scroll to top-->
        <button class="scroll-top scroll-to-target" data-target="html">
            <span class="fal fa-angle-up"></span>
        </button>
    </div>


    <!-- jequery plugins -->
    <script src="{{ asset('frontend/assets/js/jquery.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/owl.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/wow.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/validation.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.fancybox.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/appear.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/scrollbar.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/isotope.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jQuery.style.switcher.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/nav-tool.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/product-filter.js') }}"></script>

    <!-- map script -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-CE0deH3Jhj6GN4YvdCFZS7DpbXexzGU"></script>
    <script src="{{ asset('frontend/assets/js/gmaps.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/map-helper.js') }}"></script>


    <!-- main-js -->
    <script src="{{ asset('frontend/assets/js/script.js') }}"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info(" {{ Session::get('message') }} ");
                    break;

                case 'success':
                    toastr.success(" {{ Session::get('message') }} ");
                    break;

                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ");
                    break;

                case 'error':
                    toastr.error(" {{ Session::get('message') }} ");
                    break;
            }
        @endif
    </script>
    <!-- End of .page_wrapper -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- Add to Wishlist -->
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        function addToWishList(property_id) {
            var pro = 'pro_' + property_id;

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: "/add-to-wishlist/" + property_id,
                success: function(data) {
                    // Start Message 
                    $('.' + pro).addClass('active');
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {

                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success,
                        })

                    } else {

                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error,
                        })
                    }

                    // End Message
                }
            })
        }
    </script>
    <!-- // start load Wishlist Data  -->

    <script type="text/javascript">
        function wishlist() {

            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "/get-wishlist-property/",

                success: function(response) {

                    $('#wishQty').text(response.wishQty);

                    var rows = ""
                    $.each(response.wishlist, function(key, value) {

                        rows += `<div class="deals-block-one">
        <div class="inner-box">
            <div class="image-box">
                <figure class="image"><img src="/${value.property.property_thumbnail
}" alt=""></figure>
                <div class="batch"><i class="icon-11"></i></div>
                <span class="category">Featured</span>
                <div class="buy-btn"><a href="#">For ${value.property.property_status}</a></div>
            </div>
            <div class="lower-content">
                <div class="other-info-box clearfix">
                    
                    <ul class="other-option position-absolute top-0 end-0">
                       
       <li><a type="submit" class="text-body" id="${value.id}" onclick="wishlistRemove(this.id)" ><i class="fa fa-trash"></i></a></li>
                    </ul>
                </div>
                <div class="title-text"><h4><a href="">${value.property.property_name}</a></h4></div>
                <div class="price-box clearfix">
                    <div class="price-info pull-left">
                        <h6>Start From</h6>
                        <h4>$${(value.property.lowest_price)}</h4>
                    </div>
                     
                </div>
               ${value.property.short_descp}
                <ul class="more-details clearfix">
                    <li><i class="icon-14"></i>${value.property.bedrooms} Beds</li>
                    <li><i class="icon-15"></i>${value.property.    bathrooms} Baths</li>
                    <li><i class="icon-16"></i>${value.property.    property_size} Sq Ft</li>
                </ul>
                
            </div>
        </div>
    </div> `
                    });

                    $('#wishlist').html(rows);
                }
            })
        }

        wishlist();


        // Wishlist Remove Start 
        function wishlistRemove(id) {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "/wishlist-remove/" + id,

                success: function(data) {
                    wishlist();

                    // Start Message 

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',

                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {

                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success,
                        })

                    } else {

                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error,
                        })
                    }

                    // End Message  


                }
            })

        }



        /// End Wishlist Remove  
    </script>

    <script type="text/javascript">
        function addToCompare(property_id) {
            var pro = 'proc_' + property_id;
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "/add-to-compare/" + property_id,
                success: function(data) {
                    $('.' + pro).addClass('active');
                    // Start Message 
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',

                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {

                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success,
                        })
                    } else {

                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error,
                        })
                    }
                    // End Message  
                }
            })
        }
    </script>
    <script type="text/javascript">
        function compare() {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "/get-compare-property/",
                success: function(response) {
                    if (response.length > 0) {
                        var rows = "";
                        var rows_head = "";
                        var head = "";
                        var city = "";
                        var state = "";
                        var area = "";
                        var bedrooms = "";
                        var bathrooms = "";
                        var garage = "";
                        var action = "";
                        var amenitieslist = "";
                        var amenitiesnot = "";
                        var facilities = "";
                        var view = "";
                        //head with Image and name

                        $.each(response, function(key, value) {

                            head += ` <th>
                    <figure class="image-box"><img src="/${value.property.property_thumbnail}" alt=""></figure>
                    <div class="title">${value.property.property_name}</div>
                    <div class="price">$${value.property.lowest_price}</div>
                </th>`;
                            city += `<td>
                    <p>${value.property.city.name}</p>
                </td>`;
                            state += `<td>
                    <p>${value.property.state.name}</p>
                </td>`;
                            area += `<td>
                    <p>${value.property.property_size} Sq Ft</p>
                </td>`;
                            bedrooms += `<td>
                    <p>${value.property.bedrooms}</p>
                </td>`;
                            bathrooms += `<td>
                    <p>${value.property.bathrooms}</p>
                </td>`;
                            garage += `<td>
                    <p>${value.property.garage}</p>
                </td>`;
                            action += `<td>
                    <p><a href="javascript:void(0)" class="text-body" id="${value.id}" onclick="compareRemove(this.id)" ><i class="fa fa-trash"></i></a></p>
                </td>`;
                            view += `<td>
                    <p><a href="/property/details/${value.property.id}/${value.property.property_slug}" class="text-body" ><i class="fa fa-eye"></i></a></p>
                </td>`;
                            amenitiesnot = "";
                            amenitieslist += `<td>`;
                            $.each(value.property.amenities, function(key, value) {
                                amenitieslist +=
                                    `<p><i class="yes fas fa-check"></i> ${value.amenities_name}</p>`
                                console.log(value.amenities_name);
                            });


                            $.each(value.property.amenitiesNotIncluded, function(key, value) {
                                amenitiesnot +=
                                    `<p><i class="no fas fa-times"></i> ${value.amenities_name}</p>`
                                // console.log(value.amenities_name);
                            });
                            amenitieslist += amenitiesnot;
                            amenitieslist += `</td>`;

                            facilities += `<td>`;
                            $.each(value.property.facilities, function(key, value) {
                                facilities +=
                                    `<p> <strong>${value.facility_name}</strong> : (${value.distance} km)</p>`
                                // console.log(value.amenities_name);
                            });
                            facilities += `</td>`;
                        });

                        rows_head += ` <tr>
                <th>Property Info</th>${head}</tr>`;
                        rows += ` <tr>
                <td>
                    <p>State</p></td>${state}</tr>`;
                        rows += ` <tr>
                <td>
                    <p>City</p></td>${city}</tr>`;
                        rows += ` <tr>
                <td>
                    <p>Area</p></td>${area}</tr>`;
                        rows += ` <tr>
                <td>
                    <p>Rooms</p></td>${bedrooms}</tr>`;
                        rows += ` <tr>
                <td>
                    <p>Bathrooms</p></td>${bathrooms}</tr>`;
                        rows += ` <tr>
                <td>
                    <p>Garage</p></td>${garage}</tr>`;
                        rows += ` <tr>
                <td>
                    <p>Amenities</p></td>${amenitieslist} ${amenitiesnot}</tr>`;
                        rows += ` <tr>
                <td>
                    <p>Facilities</p></td>${facilities} </tr>`;
                        rows += ` <tr>
                <td>
                    View</td>${view} </tr>`;
                        rows +=
                            ` <tr>
                <td>
                    <p>Action</p></td>${action}</tr>`;
                        //End
                        $('#compare_head').html(rows_head);
                        $('#compare').html(rows);
                    } else {

                        rows += ` <tr>
                <td>
                    <p class="text-danger">No Property Found</p></td></tr>`;
                        $('#compare_head').html("");
                        $('#compare').html(rows);

                    }
                }
            })
        }
        compare();
        // Compare Remove Start 
        function compareRemove(id) {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "/compare-remove/" + id,
                success: function(data) {
                    compare();
                    // Start Message 
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',

                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {

                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success,
                        })
                    } else {

                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error,
                        })
                    }
                    // End Message  
                }
            })
        }
        /// End Compare Remove  
    </script>
</body>

</html>
