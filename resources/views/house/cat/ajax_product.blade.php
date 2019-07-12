@forelse ($objProducts as $value)
@php
    $arr = [
        'name' => str_slug($value->name),
        'id'   => $value->id,
    ]
@endphp
<div class="col-12 col-md-6 col-xl-4">
	<div class="single-featured-property mb-50">
	    <!-- Property Thumbnail -->
	    <div class="property-thumb">
	    	<a href="{{ route('house.product.index',$arr) }}">
	            <img style="height:262px;" src="{{asset('/image/files/show_image/'.$value->image)}}" alt="{{ $value->name }}">
	        </a>
	        <div class="tag">
	            <span>@if (session::get('locale') == "en"){{ $value->choose->name }}@else{{ $value->choose->name_vn }}@endif</span>
	        </div>
            <div class="status">
                <span>@if (session::get('locale') == "en"){{ $value->status->name }}@else{{ $value->status->name_vn }}@endif</span>
            </div>
	        <div class="list-price">
	            <p>${{ $value->price }}</p>
	        </div>
	    </div>
	    <!-- Property Content -->
	    <div class="property-content">
	    	<a href="{{ route('house.product.index',$arr) }}"><h5>@if(session::get('locale') == "en"){{$value->name }}@else{{ $value->name_vn }}@endif</h5></a>
	    	<h6 class="code"> ( {{$value->code}} ) </h6>
	        <p class="location"><img src="{{asset('templates/house/')}}/img/icons/location.png" alt="">
	        	@if(session::get('locale') == "en")
	        		{{ Helpers::stripUnicode($value->address) }} St., {{ Helpers::stripUnicode($value->district->name) }} @if($value->district_id <> 9) district @else City @endif @if($value->district_id <> 9), Da Nang @endif
	        	@else 
	        		Đường {{ $value->address }}, @if($value->district_id <> 9) quận @else Thành phố @endif {{ $value->district->name }} @if($value->district_id <> 9), Đà Nẵng @endif 
	        	@endif
	        </p>
	        <p>@if (session::get('locale') == "en"){{ $value->detail }}@else{{ $value->detail_vn }}@endif</p>
	        <div class="property-meta-data d-flex align-items-end justify-content-between">
				<div class="bathroom">
				    <img src="{{asset('templates/house/')}}/img/icons/bathtub.png" alt="">
				    <span>{{ $value->bathrooms}}</span>
				</div>
				<div class="garage">
				    <img src="{{asset('templates/house/')}}/img/icons/garage.png" alt="">
				    <span>{{ $value->bedrooms}}</span>
				</div>

				<div class="space">
				    <img src="{{asset('templates/house/')}}/img/icons/space.png" alt="">
				    <span>{{ $value->sqrt}} {{ __('message.S') }}</span>
				</div> 
	        </div>
	    </div>
	</div>
</div>
@empty
    <div class="col-12 col-md-6 col-xl-4">
 		{{ __('message.RESULT', ['result' => count($objProducts)]) }}
    </div>
@endforelse