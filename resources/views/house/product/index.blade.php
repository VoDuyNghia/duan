@extends('templates.house.master')
@section('content')
<!-- ##### Hero Area End ##### -->
@include('templates.house.banner')
<!-- ##### Advance Search Area Start ##### -->
<div class="south-search-area">
    @include("templates.house.fitter")
</div>
<!-- ##### Featured Properties Area Start ##### -->
<section class="listings-content-wrapper section-padding-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-breadcrumbs">
                    <nav class="property-breadcrumbs">
                        <ul>
                            <li>
                                <a href="{{ route('house.index.index') }}">{{ __('message.HOME') }}&nbsp;</a>
                                <i class="breadcrumbs-separator fa fa-angle-right">&nbsp;</i>
                            </li>
                            <li>
                                <a href="{{ route('house.cat.choose_product',strtolower($objProducts->choose->name)) }}" class="parent_cate">@if (session::get('locale') == "en"){{ $objProducts->choose->name }}@else{{ $objProducts->choose->name_vn }}@endif&nbsp;</a>
                                <i class="breadcrumbs-separator fa fa-angle-right">&nbsp;</i>
                            </li>
                            <li>
                                @if(session::get('locale') == "en"){{ $objProducts['name'] }}@else{{ $objProducts['name_vn'] }}@endif
                            </li>            
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-12">
                @if ($errors->any() or Session::has('fail') )
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li> {{ $error }} </li>
                                <li> {{ Session::get('fail') }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (Session::has('success'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{{ Session::get('success') }}</li>
                        </ul>
                    </div>
                @endif
            </div>
            <div class="col-12">
                <!-- Single Listings Slides -->
                <div class="single-listings-sliders owl-carousel">
                    @foreach ($objImage as $value)
                        <a href="{{asset('/image/files/detail_image/'.$value->image_detail)}}" class="swipebox">
                            <img class="image_detail" src="{{asset('/image/files/detail_image/'.$value->image_detail)}}" alt="image">
                            <span class="detail">{{__('message.CLICK')}}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="listings-content">
                    <!-- Price -->
                    <div class="list-price">
                        <p>${{ $objProducts['price'] }}</p>
                        <div class="fb-share-button" 
                            data-href="{{ URL::current() }}" 
                            data-layout="button_count">
                        </div>
                        <div style="line-height: 2em;" class="fb-like" 
                            data-href="{{ URL::current() }}" 
                            data-layout="standard" 
                            data-action="like" 
                            data-show-faces="true">
                        </div>
                    </div>
                    <h5> @if(session::get('locale') == "en"){{ $objProducts['name'] }}@else{{ $objProducts['name_vn'] }}@endif</h5>
                    <p class="location"><img src="{{ asset('templates/house/') }}/img/icons/location.png" alt="">
                    @if(session::get('locale') == "en")
                        {{ Helpers::stripUnicode($objProducts['address']) }} St., {{ Helpers::stripUnicode($objProducts->district->name) }} @if($objProducts['district_id'] <> 9) district @else City @endif @if($objProducts['district_id'] <> 9), Da Nang @endif
                    @else 
                        Đường {{ $objProducts['address'] }}, @if($objProducts['district_id'] <> 9) quận @else Thành phố @endif {{ $objProducts->district->name }} @if($objProducts['district_id'] <> 9), Đà Nẵng @endif 
                    @endif
                    </p>
                    <!-- Meta -->
                    <div class="property-meta-data d-flex align-items-end">
                       <div class="bathroom">
                            <img src="{{ asset('templates/house/') }}/img/icons/bathtub.png" alt="">
                            <span>{{ $objProducts['bathrooms']}}</span>
                        </div>
                        <div class="garage">
                            <img src="{{ asset('templates/house/') }}/img/icons/garage.png" alt="">
                            <span>{{ $objProducts['bedrooms']}}</span>
                        </div>
                    
                        <div class="space">
                            <img src="{{ asset('templates/house/') }}/img/icons/space.png" alt="">
                            <span>{{ $objProducts['sqrt']}} {{ __('message.S') }}</span>
                        </div>
                        
                    </div>
                    <!-- Core Features -->
                    @if ($objProducts['configuration'] <> null)
                    <ul class="listings-core-features d-flex align-items-center">
                        @if(json_decode($objProducts['configuration'], true))
                        <?php
                          $configurations = json_decode($objProducts['configuration'], true);
                          ?>
                        @endif

                    	@forelse($configurations as $key => $value)
                    			<li><i class="fa fa-check" aria-hidden="true"></i> {{ $value }}</li>
                       	@empty
                        @endforelse
                    </ul>
                    @endif
                    <div class="content">
                        @if(session::get('locale') == "en"){!! $objProducts['content'] !!}@else {!! $objProducts['content_vn'] !!}@endif
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="contact-realtor-wrapper">
                    <div class="realtor-info">
                        <img src="{{ asset('templates/house/') }}/img/bg-img/listing.jpg" alt="">
                        <div class="realtor---info">
                            <h2>DINH HOANG</h2>
                            <p>Realtor</p>
                            <h6><img src="{{ asset('templates/house/') }}/img/icons/phone-call.png" alt=""> 0905.972.521</h6>
                            <h6><img src="{{ asset('templates/house/') }}/img/icons/envelope.png" alt="">danangresidence@gmail.com</h6>
                        </div>
                        <div class="realtor--contact-form">
                            @php
                                $arr = [
                                    'name' => str_slug($objProducts['name']),
                                    'id'   =>$objProducts['id'],
                                ];
                            @endphp
                            <form autocomplete="off" action="{{ route('contact', $arr) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <input type="text" required="" class="form-control" name="username" value="{{old('username')}}" id="contact-name" placeholder="{{ __('message.NAME') }}">
                                </div>
                                <div class="form-group">
                                    <input type="number" required=""  class="form-control" name="phone" value="{{old('phone')}}"  id="contact-number" placeholder="{{ __('message.PHONE') }}">
                                </div>
                                <div class="form-group">
                                    <input type="email" required=""  required="" class="form-control" name="email" value="{{old('email')}}"  id="contact-email" placeholder="{{ __('message.EMAIL') }}">
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control"  required="" name="message" id="message" cols="30" rows="10" placeholder="{{ __('message.MESSAGE') }}">{{old('message')}}</textarea>
                                </div>
                                <button type="submit" class="btn south-btn">{{ __('message.SUBMIT') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Listing Maps -->
        <div class="row">
            <div class="col-12">
                <div class="listings-maps mt-100">
                    <address>
                        Đường {{ $objProducts['address']}} , {{ $objProducts->district->name }}, Thành Phố Đà Nẵng
                    </address>
                </div>
            </div>
        </div>
    </div>
</section>

 <script type="text/javascript">
    jQuery(function($) {
        $(".swipebox").swipebox();
    });
</script>
@endsection
