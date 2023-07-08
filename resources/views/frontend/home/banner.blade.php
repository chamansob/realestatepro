  @php
      $states = App\Models\State::pluck('name', 'name')->toArray();
      $ptypes = App\Models\PropertyType::pluck('type_name', 'type_name')->toArray();
  @endphp
  <section class="banner-section"
      style="background-image: url({{ asset('frontend/assets/images/banner/banner-1.jpg') }});">
      <div class="auto-container">
          <div class="inner-container">
              <div class="content-box centred">
                  <h2>Create Lasting Wealth Through Realshed</h2>
                  <p>Amet consectetur adipisicing elit sed do eiusmod.</p>
              </div>
              <div class="search-field">
                  <div class="tabs-box">
                      <div class="tab-btn-box">
                          <ul class="tab-btns tab-buttons centred clearfix">
                              <li class="tab-btn active-btn" data-tab="#tab-1">BUY</li>
                              <li class="tab-btn" data-tab="#tab-2">RENT</li>
                          </ul>
                      </div>
                      <div class="tabs-content info-group">
                          <div class="tab active-tab" id="tab-1">
                              <div class="inner-box">
                                  <div class="top-search">
                                      {{ Form::open(['route' => 'buy.property.search', 'class' => 'search-form', 'method' => 'post']) }}

                                      {!! Form::hidden('type', $value = 'buy') !!}
                                      <div class="row clearfix">
                                          <div class="col-lg-4 col-md-12 col-sm-12 column">
                                              <div class="form-group">
                                                  {!! Form::label('search', 'Search Property') !!}
                                                  <div class="field-input">
                                                      <i class="fas fa-search"></i>
                                                      {!! Form::search('search', $value = null, [
                                                          'class' => 'form-control',
                                                          'placeholder' => 'Search by Property, Location or Landmark...',
                                                      ]) !!}
                                                      @error('search')
                                                          <span class="text-danger pt-3">{{ $message }}</span>
                                                      @enderror
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-lg-4 col-md-6 col-sm-12 column">
                                              <div class="form-group">

                                                  {!! Form::label('state', 'Loaction') !!}
                                                  <div class="select-box">
                                                      <i class="far fa-compass"></i> <select class="wide basic-single"
                                                          name="state">
                                                          <option value="0">Select Location</option>
                                                          @foreach ($states as $state)
                                                              <option value="{{ $state }}">{{ $state }}
                                                              </option>
                                                          @endforeach
                                                      </select>



                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-lg-4 col-md-6 col-sm-12 column">
                                              <div class="form-group">

                                                  {!! Form::label('ptype_id', 'Property Type') !!}

                                                  <div class="select-box">

                                                      <select class="wide basic-single" name="ptype_id">
                                                          <option value="0">All Type</option>
                                                          @foreach ($ptypes as $ptype)
                                                              <option value="{{ $ptype }}">{{ $ptype }}
                                                              </option>
                                                          @endforeach
                                                      </select>

                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="search-btn">
                                          <button type="submit"><i class="fas fa-search"></i>Search</button>

                                      </div>
                                      {{ Form::close() }}
                                  </div>

                              </div>
                          </div>
                          <div class="tab" id="tab-2">
                              <div class="inner-box">
                                  <div class="top-search">
                                      {{ Form::open(['route' => 'buy.property.search', 'class' => 'search-form', 'method' => 'post']) }}

                                      {!! Form::hidden('type', $value = 'rent') !!}
                                      <div class="row clearfix">
                                          <div class="col-lg-4 col-md-12 col-sm-12 column">
                                              <div class="form-group">
                                                  {!! Form::label('search', 'Search Property') !!}
                                                  <div class="field-input">
                                                      <i class="fas fa-search"></i>
                                                      {!! Form::search('search', $value = null, [
                                                          'class' => 'form-control',
                                                          'placeholder' => 'Search by Property, Location or Landmark...',
                                                      ]) !!}
                                                      @error('search')
                                                          <span class="text-danger pt-3">{{ $message }}</span>
                                                      @enderror
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-lg-4 col-md-6 col-sm-12 column">
                                              <div class="form-group">

                                                  {!! Form::label('state', 'Loaction') !!}
                                                  <div class="select-box">
                                                      <i class="far fa-compass"></i>
                                                      {!! Form::Select('state', array_merge(['0' => 'Input Location'], $states), null, [
                                                          'class' => 'wide basic-single',
                                                      ]) !!}



                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-lg-4 col-md-6 col-sm-12 column">
                                              <div class="form-group">

                                                  {!! Form::label('ptype_id', 'Property Type') !!}

                                                  <div class="select-box">
                                                      {!! Form::Select('ptype_id', array_merge(['0' => 'All Type'], $ptypes), null, [
                                                          'class' => 'wide basic-single',
                                                      ]) !!}
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="search-btn">
                                          <button type="submit"><i class="fas fa-search"></i>Search</button>

                                      </div>
                                      {{ Form::close() }}
                                  </div>

                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
