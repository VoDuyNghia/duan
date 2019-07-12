<div class="col-12 col-lg-4">
    <div class="blog-sidebar-area">

        <!-- Search Widget -->
        <div class="search-widget-area mb-70">
            <form action="{{route('house.blog.search')}}" method="get">
                <input type="search" name="search" value="{{ $key_word }}" id="search" placeholder="{{ __('message.SEARCH_BLOG') }}">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <div class="featured-properties-slides owl-carousel">
            @foreach ($SliderProduct as $value)
            @php
                $arr = [
                    'name' => str_slug($value->product->name),
                    'id'   => $value->product->id,
                ];
            @endphp
            <div class="single-featured-property">
                <!-- Property Thumbnail -->
                <div class="property-thumb">
                    <a href="{{ route('house.product.index',$arr) }}"><img src="{{ asset('image/files/slider_product/'.$value->image) }}" alt="{{ $value->product->name }}"></a>
                    
                    <div class="tag">
                        <span>{{ $value->product->choose->name }}</span>
                    </div>
                <div class="status">
                    <span>@if (session::get('locale') == "en"){{ $value->product->status->name }}@else{{ $value->product->status->name }}@endif</span>
                </div>
                    <div class="list-price">
                        <p>${{$value->product->price}}</p>
                    </div>
                </div>
                <!-- Property Content -->
                <div style="text-align: left" class="property-content">
                    <a href="{{ route('house.product.index',$arr) }}"><h5>@if(session::get('locale') == "en"){{$value->product->name }}@else{{ $value->product->name_vn }}@endif</h5></a>
                    <p class="location"><img src="{{asset('templates/house/')}}/img/icons/location.png" alt="">
                        @if(session::get('locale') == "en")
                            {{ Helpers::stripUnicode($value->product->address) }} St., {{ Helpers::stripUnicode($value->product->district->name) }} @if($value->product->district_id <> 9) district @else City @endif @if($value->product->district_id <> 9), Da Nang @endif
                        @else 
                            Đường {{ $value->product->address }}, @if($value->product->district_id <> 9) quận @else Thành phố @endif {{ $value->product->district->name }} @if($value->product->district_id <> 9), Đà Nẵng @endif 
                        @endif
                    </p>
                    <p>{{$value->product->detail}}</p>
                    <div class="property-meta-data d-flex align-items-end justify-content-between">
                        <div class="bathroom">
                            <img src="{{ asset('templates/house/') }}/img/icons/bathtub.png" alt="">
                            <span>{{ $value->product->bathrooms}}</span>
                        </div>
                        <div class="garage">
                            <img src="{{ asset('templates/house/') }}/img/icons/garage.png" alt="">
                            <span>{{ $value->product->bedrooms}}</span>
                        </div>
                    
                        <div class="space">
                            <img src="{{ asset('templates/house/') }}/img/icons/space.png" alt="">
                            <span>{{ $value->product->sqrt}} {{ __('message.S') }}</span>
                        </div> 
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</div>