@extends('agent.agent_dashboard')
@section('agent')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Property</li>
                </li>
            </ol>
            <a href="{{ route('agent.properties') }}" class="btn btn-inverse-info">Show All Property</a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Edit Property</h6>
                        {!! Form::open([
                            'method' => 'put',
                            'route' => ['agent.properties.update', $property->id],
                            'class' => 'forms-sample',
                        ]) !!}
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">

                                    {!! Form::label('property_name', 'Property Name', ['class' => 'form-label']) !!}

                                    {!! Form::text('property_name', $value = $property->property_name, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Property Name',
                                    ]) !!}
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
                                    {!! Form::Select('property_status', $status, $property->property_status, [
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

                                    {!! Form::text('lowest_price', $value = $property->lowest_price, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Lowest Price',
                                    ]) !!}
                                    @error('lowest_price')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">

                                    {!! Form::label('max_price', 'Max Price', ['class' => 'form-label']) !!}

                                    {!! Form::text('max_price', $value = $property->lowest_price, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Max Price',
                                    ]) !!}
                                    @error('max_price')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3">

                                <div class="mb-3">

                                    {!! Form::label('bedrooms', 'BedRooms', ['class' => 'form-label']) !!}

                                    {!! Form::number('bedrooms', $value = $property->bedrooms, [
                                        'class' => 'form-control',
                                        'placeholder' => 'BedRooms',
                                    ]) !!}

                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-3">

                                <div class="mb-3">

                                    {!! Form::label('bathrooms', 'Bathrooms', ['class' => 'form-label']) !!}

                                    {!! Form::number('bathrooms', $value = $property->bathrooms, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Bathrooms',
                                    ]) !!}

                                </div>
                            </div><!-- Col -->

                            <div class="col-sm-3">
                                <div class="mb-3">
                                    {!! Form::label('garage', 'Garage', ['class' => 'form-label']) !!}

                                    {!! Form::text('garage', $value = $property->garage, ['class' => 'form-control', 'placeholder' => 'Garage']) !!}

                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    {!! Form::label('garage_size', 'Garage Size', ['class' => 'form-label']) !!}

                                    {!! Form::text('garage_size', $value = $property->garage_size, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Garage Size',
                                    ]) !!}

                                </div>
                            </div><!-- Col -->

                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="mb-3">

                                    {!! Form::label('address', 'Address', ['class' => 'form-label']) !!}

                                    {!! Form::text('address', $value = $property->address, ['class' => 'form-control', 'placeholder' => 'Address']) !!}

                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    {!! Form::label('state', 'State', ['class' => 'form-label']) !!}
                                    {!! Form::Select('state', $state, $property->state($property->city), [
                                        'class' => 'form-control',
                                        'id' => 'states',
                                        'placeholder' => 'Select State',
                                    ]) !!}

                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    {!! Form::label('city', 'City', ['class' => 'form-label']) !!}

                                    {!! Form::Select('city', $cities, $property->city, [
                                        'class' => 'form-control',
                                        'id' => 'cities_list',
                                        'placeholder' => 'Select city',
                                    ]) !!}
                                </div>
                            </div><!-- Col -->

                            <div class="col-sm-3">
                                <div class="mb-3">
                                    {!! Form::label('postal_code', 'Postal Code', ['class' => 'form-label']) !!}

                                    {!! Form::text('postal_code', $value = $property->postal_code, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Postal Code',
                                    ]) !!}

                                </div>
                            </div><!-- Col -->

                        </div>
                        <div class="row">

                            <div class="col-sm-4">
                                <div class="mb-3">
                                    {!! Form::label('property_size', 'Property Size', ['class' => 'form-label']) !!}

                                    {!! Form::text('property_size', $value = $property->property_size, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Property Size',
                                    ]) !!}

                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    {!! Form::label('property_video', 'Property Video', ['class' => 'form-label']) !!}

                                    {!! Form::text('property_video', $value = $property->property_video, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Property Video',
                                    ]) !!}

                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    {!! Form::label('neighborhood', 'Neighborhood', ['class' => 'form-label']) !!}

                                    {!! Form::text('neighborhood', $value = $property->neighborhood, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Neighborhood',
                                    ]) !!}

                                </div>
                            </div><!-- Col -->

                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    {!! Form::label('latitude', 'Latitude', ['class' => 'form-label']) !!}

                                    {!! Form::text('latitude', $value = $property->latitude, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Latitude',
                                    ]) !!}
                                    <div class="pt-2"><a href="https://www.latlong.net/convert-address-to-lat-long.html"
                                            target="_blank">Go
                                            here to get Latitude from address</a></div>

                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    {!! Form::label('longitude', 'Longitude', ['class' => 'form-label']) !!}

                                    {!! Form::text('longitude', $value = $property->longitude, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Longitude',
                                    ]) !!}
                                    <div class="pt-2"><a href="https://www.latlong.net/convert-address-to-lat-long.html"
                                            target="_blank">Go
                                            here to get Longitude from address</a></div>

                                </div>
                            </div><!-- Col -->
                        </div>
                        <div class="row">

                            <div class="col-sm-6">
                                <div class="mb-3">
                                    {!! Form::label('ptype_id', 'Property Type', ['class' => 'form-label']) !!}

                                    {!! Form::Select('ptype_id', $type, $property->ptype_id, [
                                        'class' => 'form-control js-example-basic-single',
                                        'placeholder' => 'Select Property Type',
                                    ]) !!}

                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-6">

                                <div class="mb-3">

                                    {!! Form::label('amenities_id', 'Property Amenities', ['class' => 'form-label']) !!}
                                    {!! Form::select('amenities_id[]', $value = $amenities, $property->amenities($property->amenities_id), [
                                        'class' => 'form-control js-example-basic-multiple',
                                        'multiple' => true,
                                    ]) !!}


                                </div>
                            </div><!-- Col -->


                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3">
                                {!! Form::label('short_descp', 'Short Description', ['class' => 'form-label']) !!}

                                {!! Form::Textarea('short_descp', $value = $property->short_descp, [
                                    'class' => 'form-control',
                                    'rows' => 2,
                                    'placeholder' => 'Short Description',
                                ]) !!}

                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-12">
                            <div class="mb-3">
                                {!! Form::label('long_descp', 'Long Description', ['class' => 'form-label']) !!}

                                {!! Form::Textarea('long_descp', $value = $property->long_descp, [
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
                                        {{ $property->featured == 1 ? 'checked' : '' }} value="1">
                                    <label class="form-check-label" for="checkInlineChecked">
                                        Featured Property
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="hot" class="form-check-input" id="checkInline"
                                        {{ $property->hot == 1 ? 'checked' : '' }} value="1">
                                    <label class="form-check-label" for="checkInline">
                                        Hot Property
                                    </label>
                                </div>

                            </div>
                        </div>

                        <!---end row-->


                        <!--========== End of add multiple class with ajax ==============-->
                        {!! Form::submit('Submit', ['class' => 'btn btn-outline-primary btn-icon-text mb-2 mb-md-0']) !!}
                        {{ Form::close() }}

                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- // Property Main Thumbnail Image Update //// -->
    <div class="page-content mt-0 pt-0">

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Edit Main Image</h6>
                        {!! Form::open([
                            'method' => 'patch',
                            'route' => ['agent.properties.update_img', $property->id],
                            'class' => 'forms-sample',
                            'files' => true,
                        ]) !!}
                        <div class="row">
                            <div class="col-sm-10">
                                <div class="mb-3">

                                    {!! Form::label('property_thumbnail', 'Main Thumbnail', ['class' => 'form-label']) !!}

                                    {!! Form::file('property_thumbnail', [
                                        'class' => 'form-control',
                                        'placeholder' => 'Main Thumbnail',
                                        'onchange' => 'mainThamUrl(this)',
                                    ]) !!}
                                    @error('property_thumbnail')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                    <div class="mt-3"><img src="" id="mainThmb"
                                            class="img-responsive border border-1">
                                    </div>
                                </div>
                            </div>
                            <?php
                            $img = explode('.', $property->property_thumbnail);
                            $small_img = $img[0] . '_thumb.' . $img[1];
                            ?>
                            <div class="mt-3 col-sm-2"><img src="{{ asset($small_img) }}"
                                    class="img-thumbnail img-fluid img-responsive w-10"></div>

                        </div>
                        {!! Form::submit('Submit', ['class' => 'btn btn-outline-primary btn-icon-text mb-2 mb-md-0']) !!}
                        {{ Form::close() }}

                    </div>
                </div>
            </div>
        </div>

    </div>
    <!--  // End Property Main Thumbnail Image Update  //-->

    <!-- // Property Multi Image Thumbnail Image Update //// -->
    <div class="page-content mt-0 pt-0">

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Edit Slider Image</h6>
                        {!! Form::open([
                            'method' => 'patch',
                            'route' => ['agent.properties.multi_img_update', $property->id],
                            'class' => 'forms-sample',
                            'files' => true,
                        ]) !!}
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="mb-3">

                                    {!! Form::label('multi_img', 'Multiple Image', ['class' => 'form-label']) !!}

                                    {!! Form::file('multi_img[]', [
                                        'class' => 'form-control',
                                        'id' => 'multiImg',
                                        'required' => true,
                                        'multiple' => true,
                                        'placeholder' => 'Multiple Image',
                                    ]) !!}

                                    <div class="row mt-3 gap-2" id="preview_img"> </div>
                                </div>
                            </div>


                        </div>
                        {!! Form::submit('Add More Images', ['class' => 'btn btn-outline-primary btn-icon-text mb-2 mb-md-0']) !!}
                        {{ Form::close() }}

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Image</th>
                                        <th>Change Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $key = 1;
                                    
                                    ?>
                                    @if (count($multiImage) > 0)
                                        @foreach ($multiImage as $multi)
                                            <?php
                                            $img = explode('.', $multi->photo_name);
                                            $small_img = $img[0] . '_small.' . $img[1];
                                            ?>
                                            {!! Form::open([
                                                'method' => 'patch',
                                                'route' => ['agent.properties.multi_img_update_one', $multi->id],
                                                'class' => 'forms-sample',
                                                'files' => true,
                                            ]) !!}
                                            <tr>
                                                <td class="p-4">{{ $key++ }}</td>
                                                <td class="p-3">
                                                    <img src="{{ asset($small_img) }}" alt="image">
                                                </td>
                                                <td>

                                                    {!! Form::file('multi_img', [
                                                        'class' => 'form-control',
                                                        'required' => true,
                                                    ]) !!}
                                                </td>

                                                <td>{!! Form::submit('Update Image', ['class' => 'btn btn-outline-primary btn-icon-text mb-2 mb-md-0']) !!}


                                                    <a href="{{ route('agent.properties.multi_img_delete', $multi->id) }}"
                                                        class="btn btn-outline-danger btn-icon-text mb-2 mb-md-0"
                                                        id="delete">Delete </a>
                                                </td>

                                            </tr>

                                            {{ Form::close() }}
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" class="text-center text-danger">No Data Found</td>
                                        </tr>
                                    @endif

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <!--  // End Property Main Thumbnail Image Update  //-->

    <!-- // Property Multi Image Thumbnail Image Update //// -->
    <div class="page-content mt-0 pt-0">

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Edit Property Facility</h6>
                        {!! Form::open([
                            'method' => 'patch',
                            'route' => ['agent.properties.facility_update', $property->id],
                            'class' => 'forms-sample',
                        ]) !!}
                        <?php
                        $facility_list = ['Hospital', 'SuperMarket', 'School', 'Entertainment', 'Pharmacy', 'Airport', 'Railways', 'Bus Stop', 'Beach', 'Mall', 'Bank'];
                        ?>
                        @foreach ($facilities as $item)
                            <div class="row add_item">
                                <div class="whole_extra_item_add" id="whole_extra_item_add">
                                    <div class="whole_extra_item_delete" id="whole_extra_item_delete">
                                        <div class="container mt-2">
                                            <div class="row">

                                                <div class="form-group col-md-4">

                                                    {!! Form::label('facility_name', 'Facilities', ['class' => 'form-label']) !!}

                                                    {!! Form::hidden('facility_ids[]', $value = $item->id) !!}
                                                    {!! Form::Select('facility_name[]', $facility_list, array_search($item->facility_name, $facility_list), [
                                                        'class' => 'form-control',
                                                        'id' => 'facility_name',
                                                        'placeholder' => 'Select Facility',
                                                    ]) !!}

                                                </div>
                                                <div class="form-group col-md-4">

                                                    {!! Form::label('distance', 'Distance', ['class' => 'form-label']) !!}
                                                    {!! Form::text('distance[]', $value = $item->distance, [
                                                        'class' => 'form-control',
                                                        'id' => 'distance',
                                                        'placeholder' => 'Distance',
                                                    ]) !!}

                                                </div>
                                                <div class="form-group col-md-4" style="padding-top: 20px">
                                                    <span class="btn btn-success btn-sm addeventmore"><i
                                                            class="fa fa-plus-circle">Add</i></span>
                                                    <a href="{{ route('properties.facility_delete', $item->id) }}"
                                                        class="btn btn-danger btn-sm " id="delete">
                                                        <i class="fa fa-minus-circle">Remove</i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="mt-3 ms-2"> <button type="submit" class="btn btn-primary">Save Changes </button>
                        </div>
                        {{ Form::close() }}

                    </div>
                </div>
            </div>
        </div>

    </div>

    <!--  // End Property Main Thumbnail Image Update  //-->
    <script type="text/javascript">
        $(document).ready(function() {
            var counter = 0;
            $(document).on("click", ".addeventmore", function() {
                var whole_extra_item_add = $("#whole_extra_item_add").html();
                console.log(whole_extra_item_add);
                $(this).closest(".add_item").append(whole_extra_item_add);
                counter++;
            });

        });
    </script>
    <!--========== End of add multiple class with ajax ==============-->

    <script type="text/javascript">
        $(function() {
            'use strict';


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
                    url: "{{ route('properties.states') }}",
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
