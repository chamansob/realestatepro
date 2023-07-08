@php
    $rent = App\Models\Property::where('status', '1')
        ->where('property_status', 'rent')
        ->get();
    $buy = App\Models\Property::where('status', '1')
        ->where('property_status', 'buy')
        ->get();
    $states = App\Models\State::pluck('name', 'name')->toArray();
    $ptypes = App\Models\PropertyType::pluck('type_name', 'type_name')->toArray();
@endphp
<div class="default-sidebar property-sidebar">
    {{ Form::open(['route' => 'all.property.search', 'class' => 'search-form', 'method' => 'post']) }}

    <div class="filter-widget sidebar-widget">
        <div class="widget-title">
            <h5>Property</h5>
        </div>
        <div class="widget-content">
            <div class="select-box">
                <select name="property_status" class="wide">
                    <option data-display="All Type" value="">All Status</option>
                    <option value="rent">Rent</option>
                    <option value="buy">Buy</option>
                </select>
            </div>
            <div class="select-box">
                {!! Form::Select('ptype_id', $value = array_merge(['0' => 'Select Type'], $ptypes), [
                    'class' => 'wide',
                    'placeholder' => 'Property Type',
                ]) !!}
            </div>
            <div class="select-box">
                {!! Form::Select('state', $value = array_merge(['0' => 'Input Location'], $states), [
                    'class' => 'wide',
                    'placeholder' => 'Location',
                ]) !!}
            </div>

            <div class="select-box">
                <select name="bedrooms" class="wide">
                    <option data-display="Rooms" value="">Max Rooms</option>
                    <option value="1">1 Rooms</option>
                    <option value="2">2 Rooms</option>
                    <option value="3">3 Rooms</option>
                    <option value="4">4 Rooms</option>
                    <option value="5">5 Rooms</option>
                </select>
            </div>
            <div class="select-box">
                <select name="bathrooms" class="wide">
                    <option data-display="BathRooms" value="">Max BathRoom</option>
                    <option value="1">1 BathRoom</option>
                    <option value="2">2 BathRoom</option>
                    <option value="3">3 BathRoom</option>
                    <option value="4">4 BathRoom</option>
                    <option value="5">5 BathRoom</option>
                </select>
            </div>
            <div class="price-filter py-4">
                <div class="widget-title">
                    <h5>Select Price Range</h5>
                </div>
                <div class="range-slider clearfix">
                    <div class="clearfix">
                        <div class="input">
                            <input type="text" class="property-amount" name="price_range" readonly="">
                        </div>
                    </div>
                    <div class="price-range-slider"></div>
                </div>
            </div>

            <div class="filter-btn">
                <button type="submit" class="theme-btn btn-one"><i class="fas fa-filter"></i>&nbsp;Filter</button>
            </div>
        </div>
    </div>

    <div class="category-widget sidebar-widget">
        <div class="widget-title">
            <h5>Status Of Property</h5>
        </div>
        <ul class="category-list clearfix">
            <li><a href="{{ route('rent.property') }}">For Rent <span>({{ count($rent) }})</span></a></li>
            <li><a href="{{ route('buy.property') }}">For Buy <span>({{ count($buy) }})</span></a></li>
        </ul>
    </div>
    {{ Form::close() }}
</div>
