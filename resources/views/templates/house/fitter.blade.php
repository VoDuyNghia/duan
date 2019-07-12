<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="advanced-search-form">
                <!-- Search Title -->
                <div class="search-title">
                    <p>{{ __('message.SEARCH') }}</p>
                </div>
                <!-- Search Form -->
                <form action="{{ route('house.index.search_product') }}" method="get" id="advanceSearch">
                    <div class="row">
                        <div class="col-12 col-md-4 col-lg-3">
                            <div class="form-group">
                                <input type="input" value='{{ $key_word }}' class="form-control" name="input" placeholder="{{ __('message.KEYWORD') }}">
                            </div>
                        </div>

                        <div class="col-12 col-md-4 col-lg-3">
                            <div class="form-group">
                                <select class="form-control" name="cities" id="cities">
                                    <option value = "0">{{ __('message.CITIES') }}</option>
                                    @foreach ($objDistrict as $value)
                                        <option value="{{$value->id}}" @if($value->id == $district) selected @endif>{{$value->name}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-4 col-lg-3">
                            <div class="form-group">
                                <select class="form-control" name="collection"  id="collection">
                                    <option value = "0">{{ __('message.CATEGORY') }}</option>
                                    @foreach ($objCollection as $value)
                                        <option value="{{$value->id}}" @if($value->id == $collection) selected @endif>@if (session::get('locale') == "en"){{ $value->name }}@else{{ $value->name_vn }}@endif</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-4 col-lg-3">
                            <div class="form-group">
                                <select class="form-control" name="status" id="status">
                                    <option value = "0">{{ __('message.COLLECTION') }}</option>
                                    @foreach ($objChoose as $value)
                                        <option value="{{$value->id}}" @if($value->id == $choose) selected @endif>@if (session::get('locale') == "en"){{ $value->name }}@else{{ $value->name_vn }}@endif</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-4 col-xl-2">
                            <div class="form-group">
                                <select class="form-control" name="bedrooms" id="bedrooms">
                                    <option value= "0">{{ __('message.BEDROOMS') }}</option>
                                    <option <?php if ($bedrooms == 1 ) echo 'selected' ; ?>  value="1">1</option>
                                    <option <?php if ($bedrooms == 2 ) echo 'selected' ; ?>  value="2">2</option>
                                    <option <?php if ($bedrooms == 3 ) echo 'selected' ; ?>  value="3">3</option>
                                    <option <?php if ($bedrooms == 4 ) echo 'selected' ; ?>  value="4">4</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-4 col-xl-2">
                            <div class="form-group">
                                <select class="form-control" name="bathrooms" id="bathrooms">
                                    <option value = "0">{{ __('message.BATHROOMS') }}</option>
                                    <option <?php if ($bathrooms == 1 ) echo 'selected' ; ?>  value="1">1</option>
                                    <option <?php if ($bathrooms == 2 ) echo 'selected' ; ?>  value="2">2</option>
                                    <option <?php if ($bathrooms == 3 ) echo 'selected' ; ?>  value="3">3</option>
                                    <option <?php if ($bathrooms == 4 ) echo 'selected' ; ?>  value="4">4</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-8 col-lg-12 col-xl-8 d-flex">
                            <!-- Space Range -->
                            <div class="slider-range">
                                <div data-min="120" data-max="820" data-unit=" sq. ft" class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" data-value-min="120" data-value-max="820">
                                    <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                                    <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                    <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                </div>
                                <div class="range">120 sq. ft - 820 sq. ft</div>
                                <input type="text" name="mix_sqrt" id="mix_sqrt" hidden="" >
                                <input type="text" name="max_sqrt" id="max_sqrt" hidden="" >
                            </div>

                            <!-- Distance Range -->
                            <div class="slider-range">
                                <div  data-unit=" $" data-min="50" data-max="5000" class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" data-value-min="50" data-value-max="5000">
                                    <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                                    <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                    <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                </div>
                                <div class="range">$ 50 - $ 5000 </div>
                                <input type="text" name="min_price" id="min_price" hidden="" >
                                <input type="text" name="max_price" id="max_price" hidden="" >
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-between align-items-end">
                            <!-- Submit -->
                            <div class="form-group mb-0">
                                <button type="submit" class="btn south-btn">{{  __('message.SEARCH') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>