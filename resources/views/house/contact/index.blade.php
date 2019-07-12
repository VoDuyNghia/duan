@extends('templates.house.master')
@section('content')
    <section class="breadcumb-area bg-img" style="background-image: url(/public/templates/house/img/bg-img/hero1.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcumb-content">
                        <h3 class="breadcumb-title">{{ __('message.CONTACT') }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Breadcumb Area End ##### -->

    <section class="south-contact-area section-padding-100">
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <div class="contact-heading">
                        <h6>{{ __('message.CONTACT_INFO') }}</h6>
                    </div>
                </div>

                <div class="col-8">
                    @if (Session::has('success'))
                     	<div class="alert alert-success">
                            <ul>
                                <li>{{ Session::get('success') }}</li>
                                <li> Hệ thống sẽ tự động chuyển về trang chủ sau: <span id="countdown"> 5 </span> seconds</li>
                            </ul>
                        </div>
						<script type="text/javascript">
						    var seconds = 5;
						    
						    function countdown() {
						        seconds = seconds - 1;
						        if (seconds < 0) {
						            window.location = "{{ route('house.index.index') }}";
						        } else {
						            document.getElementById("countdown").innerHTML = seconds;
						            window.setTimeout("countdown()", 1000);
						        }
						    }
						    countdown();
						</script>
                     @endif 

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
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-4">
                    <div class="content-sidebar">
                        <!-- Office Hours -->
                        <div class="weekly-office-hours">
                            <ul>
                                <li class="d-flex align-items-center justify-content-between"><span>Monday - Friday</span> <span>09 AM - 19 PM</span></li>
                                <li class="d-flex align-items-center justify-content-between"><span>Saturday</span> <span>09 AM - 14 PM</span></li>
                                <li class="d-flex align-items-center justify-content-between"><span>Sunday</span> <span>Closed</span></li>
                            </ul>
                        </div>
                        <!-- Address -->
                        <div class="address mt-30">
                            <h6><img src="{{asset('templates/house/')}}/img/icons/phone-call.png" alt=""> 0798.739.286</h6>
                            <h6><img src="{{asset('templates/house/')}}/img/icons/envelope.png" alt=""> danangresidence@gmail.com</h6>
                            <h6><img src="{{asset('templates/house/')}}/img/icons/location.png" alt=""> Main Str. no 45-46, b3, 56832,<br>Los Angeles, CA</h6>
                        </div>
                    </div>
                </div>

                <!-- Contact Form Area -->
                <div class="col-12 col-lg-8">
                    <div class="contact-form">
                        <form autocomplete="off" action="{{ route('house.contact.index') }}" method="post">
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
    </section>

    <!-- Google Maps -->
    <div class="map-area mb-100">
        <div class="container">
            <div class="row">
                <address>
                    Chung Cư NestHome , 66 Dương Văn An , Phường Mân Thái
                </address>
            </div>
        </div>
	</div>
    @include('templates.house.describe')
@endsection