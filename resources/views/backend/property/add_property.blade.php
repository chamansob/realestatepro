@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Property</li>
                </li>
            </ol>
            <a href="{{ route('properties.index') }}" class="btn btn-inverse-info">Show All Property</a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Add Property Type</h6>
                        {{ Form::open(['route' => 'properties.store', 'class' => 'forms-sample', 'id' => 'myForm', 'method' => 'post', 'files' => true]) }}
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">

                                    {!! Form::label('property_name', 'Property Name', ['class' => 'form-label']) !!}

                                    {!! Form::text('property_name', $value = null, ['class' => 'form-control', 'placeholder' => 'Property Name']) !!}
                                    @error('property_name')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">

                                    {!! Form::label('property_status', 'Property Name', ['class' => 'form-label']) !!}
                                    <?php
                                    $status = [
                                        'rent' => 'Rent',
                                        'sale' => 'Sale',
                                    ];
                                    ?>
                                    {!! Form::Select('property_status', $status, null, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Select Status',
                                    ]) !!}
                                    @error('property_status')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">

                                    {!! Form::label('lowest_price', 'Lowest Price', ['class' => 'form-label']) !!}

                                    {!! Form::text('lowest_price', $value = null, ['class' => 'form-control', 'placeholder' => 'Lowest Price']) !!}
                                    @error('lowest_price')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">

                                    {!! Form::label('max_price', 'Max Price', ['class' => 'form-label']) !!}

                                    {!! Form::text('max_price', $value = null, ['class' => 'form-control', 'placeholder' => 'Max Price']) !!}
                                    @error('max_price')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">

                                    {!! Form::label('property_thambnail', 'Main Thumbnail', ['class' => 'form-label']) !!}

                                    {!! Form::file('property_thumbnail', [
                                        'class' => 'form-control',
                                        'placeholder' => 'Main Thumbnail',
                                        'onchange' => 'mainThamUrl(this)',
                                    ]) !!}
                                    @error('property_thumbnail')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                    <img src="" id="mainThmb">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">

                                    {!! Form::label('multi_img', 'Multiple Image', ['class' => 'form-label']) !!}

                                    {!! Form::file('multi_img[]', [
                                        'class' => 'form-control',
                                        'id' => 'multiImg',
                                        'multiple' => true,
                                        'placeholder' => 'Multiple Image',
                                    ]) !!}
                                    <div class="row mt-3 gap-2" id="preview_img"> </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">

                                <div class="mb-3">

                                    {!! Form::label('bedrooms', 'BedRooms', ['class' => 'form-label']) !!}

                                    {!! Form::number('bedrooms', $value = null, ['class' => 'form-control', 'placeholder' => 'BedRooms']) !!}

                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-3">

                                <div class="mb-3">

                                    {!! Form::label('bathrooms', 'Bathrooms', ['class' => 'form-label']) !!}

                                    {!! Form::number('bathrooms', $value = null, ['class' => 'form-control', 'placeholder' => 'Bathrooms']) !!}

                                </div>
                            </div><!-- Col -->

                            <div class="col-sm-3">
                                <div class="mb-3">
                                    {!! Form::label('garage', 'Garage', ['class' => 'form-label']) !!}

                                    {!! Form::text('garage', $value = null, ['class' => 'form-control', 'placeholder' => 'Garage']) !!}

                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    {!! Form::label('garage_size', 'Garage Size', ['class' => 'form-label']) !!}

                                    {!! Form::text('garage_size', $value = null, ['class' => 'form-control', 'placeholder' => 'Garage Size']) !!}

                                </div>
                            </div><!-- Col -->

                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="mb-3">

                                    {!! Form::label('address', 'Address', ['class' => 'form-label']) !!}

                                    {!! Form::text('address', $value = null, ['class' => 'form-control', 'placeholder' => 'Address']) !!}

                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    {!! Form::label('state', 'State', ['class' => 'form-label']) !!}
                                    {!! Form::Select('state', $state, null, [
                                        'class' => 'form-control',
                                        'id' => 'states',
                                        'placeholder' => 'Select State',
                                    ]) !!}

                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    {!! Form::label('city', 'City', ['class' => 'form-label']) !!}

                                    {!! Form::Select('city', [], null, [
                                        'class' => 'form-control',
                                        'id' => 'cities_list',
                                        'placeholder' => 'Select city',
                                    ]) !!}
                                </div>
                            </div><!-- Col -->

                            <div class="col-sm-3">
                                <div class="mb-3">
                                    {!! Form::label('postal_code', 'Postal Code', ['class' => 'form-label']) !!}

                                    {!! Form::text('postal_code', $value = null, ['class' => 'form-control', 'placeholder' => 'Postal Code']) !!}

                                </div>
                            </div><!-- Col -->

                        </div>
                        <div class="row">

                            <div class="col-sm-4">
                                <div class="mb-3">
                                    {!! Form::label('property_size', 'Property Size', ['class' => 'form-label']) !!}

                                    {!! Form::text('property_size', $value = null, ['class' => 'form-control', 'placeholder' => 'Property Size']) !!}

                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    {!! Form::label('property_video', 'Property Video', ['class' => 'form-label']) !!}

                                    {!! Form::text('property_video', $value = null, ['class' => 'form-control', 'placeholder' => 'Property Video']) !!}

                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    {!! Form::label('neighborhood', 'Neighborhood', ['class' => 'form-label']) !!}

                                    {!! Form::text('neighborhood', $value = null, ['class' => 'form-control', 'placeholder' => 'Neighborhood']) !!}

                                </div>
                            </div><!-- Col -->

                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    {!! Form::label('latitude', 'Latitude', ['class' => 'form-label']) !!}

                                    {!! Form::text('latitude', $value = null, ['class' => 'form-control', 'placeholder' => 'Latitude']) !!}
                                    <div class="pt-2"><a href="https://www.latlong.net/convert-address-to-lat-long.html"
                                            target="_blank">Go
                                            here to get Latitude from address</a></div>

                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    {!! Form::label('longitude', 'Longitude', ['class' => 'form-label']) !!}

                                    {!! Form::text('longitude', $value = null, ['class' => 'form-control', 'placeholder' => 'Longitude']) !!}
                                    <div class="pt-2"><a href="https://www.latlong.net/convert-address-to-lat-long.html"
                                            target="_blank">Go
                                            here to get Longitude from address</a></div>

                                </div>
                            </div><!-- Col -->
                        </div>
                        <div class="row">

                            <div class="col-sm-4">
                                <div class="mb-3">
                                    {!! Form::label('ptype_id', 'Property Type', ['class' => 'form-label']) !!}

                                    {!! Form::Select('ptype_id', $type, null, [
                                        'class' => 'form-control js-example-basic-single',
                                        'placeholder' => 'Select Property Type',
                                    ]) !!}

                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    {!! Form::label('amenities_id', 'Property Amenities', ['class' => 'form-label']) !!}
                                    {!! Form::select('amenities_id[]', $value = $amenities, null, [
                                        'class' => 'form-control js-example-basic-multiple',
                                        'multiple' => true,
                                    ]) !!}


                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    {!! Form::label('neighborhood', 'Agent ', ['class' => 'form-label']) !!}
                                    {!! Form::Select('neighborhood', $agent, null, [
                                        'class' => 'form-control js-example-basic-single',
                                        'placeholder' => 'Select Neighborhood',
                                    ]) !!}

                                </div>
                            </div><!-- Col -->

                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3">
                                {!! Form::label('short_descp', 'Short Description', ['class' => 'form-label']) !!}

                                {!! Form::Textarea('short_descp', $value = null, [
                                    'class' => 'form-control',
                                    'rows' => 2,
                                    'placeholder' => 'Short Description',
                                ]) !!}

                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-12">
                            <div class="mb-3">
                                {!! Form::label('long_descp', 'Long Description', ['class' => 'form-label']) !!}

                                {!! Form::Textarea('long_descp', $value = null, [
                                    'class' => 'form-control',
                                    'id' => 'tinymceExample',
                                    'rows' => 2,
                                    'placeholder' => 'Long Description',
                                ]) !!}

                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="featured" class="form-check-input" id="checkInlineChecked"
                                        value="1">
                                    <label class="form-check-label" for="checkInlineChecked">
                                        Featured Property
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="hot" class="form-check-input" id="checkInline"
                                        value="1">
                                    <label class="form-check-label" for="checkInline">
                                        Hot Property
                                    </label>
                                </div>

                            </div>
                        </div>

                        <!-- Facilities Option Started -->
                        <div class="row add_item">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    {!! Form::label('facility_name', 'Facilities', ['class' => 'form-label']) !!}

                                    <select name="facility_name[]" id="facility_name" class="form-control">
                                        <option value="">Select Facility</option>
                                        <option value="Hospital">Hospital</option>
                                        <option value="SuperMarket">Super Market</option>
                                        <option value="School">School</option>
                                        <option value="Entertainment">Entertainment</option>
                                        <option value="Pharmacy">Pharmacy</option>
                                        <option value="Airport">Airport</option>
                                        <option value="Railways">Railways</option>
                                        <option value="Bus Stop">Bus Stop</option>
                                        <option value="Beach">Beach</option>
                                        <option value="Mall">Mall</option>
                                        <option value="Bank">Bank</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="distance" class="form-label"> Distance </label>
                                    <input type="text" name="distance[]" id="distance" class="form-control"
                                        placeholder="Distance (Km)">
                                </div>
                            </div>
                            <div class="form-group col-md-4" style="padding-top: 30px;">
                                <a class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> Add More..</a>
                            </div>
                        </div>
                        <!---End Facilities Option Started-->





                        <!--========== Start of add multiple class with ajax ==============-->
                        <div style="visibility: hidden">
                            <div class="whole_extra_item_add" id="whole_extra_item_add">
                                <div class="whole_extra_item_delete" id="whole_extra_item_delete">
                                    <div class="container mt-2">
                                        <div class="row">

                                            <div class="form-group col-md-4">
                                                <label for="facility_name">Facilities</label>
                                                <select name="facility_name[]" id="facility_name" class="form-control">
                                                    <option value="">Select Facility</option>
                                                    <option value="Hospital">Hospital</option>
                                                    <option value="SuperMarket">Super Market</option>
                                                    <option value="School">School</option>
                                                    <option value="Entertainment">Entertainment</option>
                                                    <option value="Pharmacy">Pharmacy</option>
                                                    <option value="Airport">Airport</option>
                                                    <option value="Railways">Railways</option>
                                                    <option value="Bus Stop">Bus Stop</option>
                                                    <option value="Beach">Beach</option>
                                                    <option value="Mall">Mall</option>
                                                    <option value="Bank">Bank</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="distance">Distance</label>
                                                <input type="text" name="distance[]" id="distance"
                                                    class="form-control" placeholder="Distance (Km)">
                                            </div>
                                            <div class="form-group col-md-4" style="padding-top: 20px">
                                                <span class="btn btn-success btn-sm addeventmore"><i
                                                        class="fa fa-plus-circle">Add</i></span>
                                                <span class="btn btn-danger btn-sm removeeventmore"><i
                                                        class="fa fa-minus-circle">Remove</i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!----For Section-------->

                        <!--========== End of add multiple class with ajax ==============-->
                        {!! Form::submit('Submit', ['class' => 'btn btn-outline-primary btn-icon-text mb-2 mb-md-0']) !!}
                        {{ Form::close() }}

                    </div>
                </div>
            </div>
        </div>

    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            var counter = 0;
            $(document).on("click", ".addeventmore", function() {
                var whole_extra_item_add = $("#whole_extra_item_add").html();
                $(this).closest(".add_item").append(whole_extra_item_add);
                counter++;
            });
            $(document).on("click", ".removeeventmore", function(event) {
                $(this).closest("#whole_extra_item_delete").remove();
                counter -= 1
            });
        });
    </script>
    <!--========== End of add multiple class with ajax ==============-->

    <script type="text/javascript">
        $(function() {
            'use strict';

            // $.validator.setDefaults({
            //     submitHandler: function() {
            //         alert("submitted!");
            //     }
            // });
            $(function() {
                $('#myForm').validate({
                    rules: {
                        property_name: {
                            required: true,
                        },
                        property_status: {
                            required: true,
                        },
                        lowest_price: {
                            required: true,
                        },
                        max_price: {
                            required: true,
                        },
                        ptype_id: {
                            required: true,
                        },


                    },
                    messages: {
                        property_name: {
                            required: 'Please Enter Property Name',
                        },
                        property_status: {
                            required: 'Please Select Property Status',
                        },
                        lowest_price: {
                            required: 'Please Enter Lowest Price',
                        },
                        max_price: {
                            required: 'Please Enter Max Price',
                        },
                        ptype_id: {
                            required: 'Please Select Property Type',
                        },


                    },
                    errorElement: 'span',
                    errorPlacement: function(error, element) {
                        error.addClass('invalid-feedback');
                        element.closest('.form-group').append(error);
                    },
                    highlight: function(element, errorClass, validClass) {
                        $(element).addClass('is-invalid');
                    },
                    unhighlight: function(element, errorClass, validClass) {
                        $(element).removeClass('is-invalid');
                    },
                });
            });
        });
    </script>


    <script type="text/javascript">
        function mainThamUrl(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#mainThmb').attr('src', e.target.result).width(80).height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#states').on('change', function() {
                var state_id = this.value;
                var crf = '{{ csrf_token() }}';
                $.ajax({
                    url: "states",
                    type: "POST",
                    data: {
                        _token: crf,
                        state_id: state_id
                    },
                    cache: false,
                    success: function(result) {
                        $("#cities_list").html(result);
                    }
                });
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            $('#multiImg').on('change', function() { //on file input change                
                if (window.File && window.FileReader && window.FileList && window
                    .Blob) //check File API supported browser
                {
                    var data = $(this)[0].files; //this file data

                    $.each(data, function(index, file) { //loop though each file
                        if (/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file
                                .type)) { //check supported file type
                            var fRead = new FileReader(); //new filereader
                            fRead.onload = (function(file) { //trigger function on successful read
                                return function(e) {
                                    var img = $('<img/>').addClass(
                                            'thumb img-responsive border border-1')
                                        .attr('src',
                                            e.target.result).width(100)
                                        .height(80); //create image element 
                                    $('#preview_img').append(
                                        img); //append image to output element
                                };
                            })(file);
                            fRead.readAsDataURL(file); //URL representing the file's data.
                        }
                    });

                } else {
                    alert("Your browser doesn't support File API!"); //if File API is absent
                }
            });
        });
    </script>
@endsection
