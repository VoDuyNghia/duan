<footer class="footer-area section-padding-100-0 bg-img gradient-background-overlay" style="background-image: url(/templates/house/img/bg-img/cta.jpg);">
    <!-- Main Footer Area -->
    <div class="main-footer-area">
        <div class="container">
            <div class="row">

                <!-- Single Footer Widget -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="footer-widget-area mb-100">
                        <!-- Widget Title -->
                        <div class="widget-title">
                            <h6>{{ __('message.ABOUT') }}</h6>
                        </div>

                        <img src="{{asset('templates/house/')}}/img/bg-img/footer.jpg" alt="">
                        <div class="footer-logo my-4">
                            <img src="{{asset('templates/house/')}}/img/core-img/logo.png" alt="">
                        </div>
                        <p>{{ __('message.SOLOGAN') }}</p>
                    </div>
                </div>

                <!-- Single Footer Widget -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="footer-widget-area mb-100">
                        <!-- Widget Title -->
                        <div class="widget-title">
                            <h6>{{ __('message.HOURS') }}</h6>
                        </div>
                        <!-- Office Hours -->
                        <div class="weekly-office-hours">
                            <ul>
                                <li class="d-flex align-items-center justify-content-between"><span>Monday - Sunday</span> <span>09 AM - 18 PM</span></li>
                            </ul>
                        </div>
                        <!-- Address -->
                        <div class="address">
                            <h6><img src="{{asset('templates/house/')}}/img/icons/phone-call.png" alt=""> 0798.739.286</h6>
                            <h6><img src="{{asset('templates/house/')}}/img/icons/envelope.png" alt=""> danangresidence@gmail.com</h6>
                            <h6><img src="{{asset('templates/house/')}}/img/icons/location.png" alt=""> {{ __('message.ADDRESS') }}</h6>
                        </div>
                    </div>
                </div>

                <!-- Single Footer Widget -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="footer-widget-area mb-100">
                        <!-- Widget Title -->
                        <div class="widget-title">
                            <h6>{{ __('message.USEFUL_LINKS') }}</h6>
                        </div>
                        <!-- Nav -->
                        <ul class="useful-links-nav d-flex align-items-center">
                            <li><a href="{{ route('house.page.about') }}">{{ __('message.ABOUT') }}</a></li>
                            <li><a href="{{ route('house.blog.index') }}">{{ __('message.BLOG') }}</a></li>
                            <li><a href="{{ route('house.contact.index') }}">{{ __('message.CONTACT') }}</a></li>
                            @foreach ($objChoose as $value)
                                <li>
                                    <a href="{{ route('house.cat.choose_product',strtolower($value->name)) }}">@if (session::get('locale') == "en"){{$value->name}}@else{{$value->name_vn }}@endif </a>
                                </li>
                            @endforeach
                            <li><a href="{{ route('house.blog.project.index') }}">{{ __('message.PROJECT') }}</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Single Footer Widget -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="footer-widget-area mb-100">
                        <!-- Widget Title -->
                        <div class="widget-title">
                            <h6>{{ __('message.IMAGE_COMPANY') }}</h6>
                        </div>
                        <!-- Featured Properties Slides -->
                        <div class="featured-properties-slides owl-carousel">
                            <!-- Single Slide -->
                            <div class="single-featured-properties-slide">
                                <a href="#"><img src="{{asset('templates/house/')}}/img/bg-img/fea-product.jpg" alt=""></a>
                            </div>
                            <!-- Single Slide -->
                            <div class="single-featured-properties-slide">
                                <a href="#"><img src="{{asset('templates/house/')}}/img/bg-img/fea-product.jpg" alt=""></a>
                            </div>
                            <!-- Single Slide -->
                            <div class="single-featured-properties-slide">
                                <a href="#"><img src="{{asset('templates/house/')}}/img/bg-img/fea-product.jpg" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Copywrite Text -->
    <div class="copywrite-text d-flex align-items-center justify-content-center">
        <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Copyright <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="{{route('house.index.index')}}" target="_blank">DNR TEAM</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
    </div>
</footer>
<!-- ##### Footer Area End ##### -->

<!-- jQuery (Necessary for All JavaScript Plugins) -->

<script src="{{ asset('templates/house/') }}/js/popper.min.js"></script>
<!-- Bootstrap js -->
<script src="{{ asset('templates/house/') }}/js/bootstrap.min.js"></script>
<!-- Plugins js -->
<script src="{{ asset('templates/house/') }}/js/plugins.js"></script>
<script src="{{ asset('templates/house/') }}/js/classy-nav.min.js"></script>
<script src="{{ asset('templates/house/') }}/js/jquery-ui.min.js"></script>
<!-- Active js -->
<script src="{{ asset('templates/house/') }}/js/active.js"></script>
<script src="{{ asset('templates/house/') }}/js/map-active.js"></script>
</body>

</html>
