<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:url"           content="{{ URL::current() }}" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="{{ $title }}" />
    <meta property="og:description"   content="{{ $description }}" />
    <meta property="og:image"         content="{{ $image }}" />
    <title>{{$title}}</title>
    <link rel="icon" href="{{ asset('/templates/house/') }}/img/core-img/logo.png">
    <script src="{{ asset('/templates/house/') }}/js/jquery/jquery-2.2.4.min.js"></script>
    <link rel="stylesheet" href="{{ asset('/templates/house/') }}/style.css">
    <script src="{{ asset('templates/house') }}/jquery.swipebox.js"></script>
    <link rel="stylesheet" href="{{ asset('templates/house') }}/swipebox.css">
    <style>
    @import url(https://weloveiconfonts.com/api/?family=entypo);
    /* entypo */
    [class*="entypo-"]:before {
       font-family: "entypo", sans-serif;
    }
    #sticky-social a { 
       text-decoration: none;
    }
    #sticky-social ul {
       list-style: none;
       margin: 0;
       padding: 0;
    }
    #sticky-social .container {
       margin: 0 auto;
       padding: 20px 50px;
       background: white;
    }
    #sticky-social {
        z-index: 10;
        left: 0;
        position: fixed;
        top: 150px;
    }
    #sticky-social a {
       background: #333;
       color: #fff;
       display: block;
       height: 35px;
       font: 16px "Open Sans", sans-serif;
       line-height: 35px;
       position: relative;
       text-align: center;
       width: 35px;
    }
    #sticky-social a span {
       line-height: 35px;
       left: -120px;
       position: absolute;
       text-align:center;
       width:120px;
    }
    #sticky-social a:hover span {
       left: 100%;
    }
    #sticky-social a[class*="facebook"],
    #sticky-social a[class*="facebook"]:hover,
    #sticky-social a[class*="facebook"] span { background: #3b5998; }

    #sticky-social a[class*="twitter"],
    #sticky-social a[class*="twitter"]:hover,
    #sticky-social a[class*="twitter"] span { background: #00aced; }

    #sticky-social a[class*="gplus"],
    #sticky-social a[class*="gplus"]:hover,
    #sticky-social a[class*="gplus"] span { background: #dd4b39; }  


    #sticky-social a[class*="instagrem"],
    #sticky-social a[class*="instagrem"]:hover,
    #sticky-social a[class*="instagrem"] span { background: #517fa4; }  
    </style>
</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="south-load"></div>
    </div>

    <!-- ##### Header Area Start ##### -->
    <header style="position: fixed;" class="header-area">
        <!-- Top Header Area -->
        <div class="top-header-area">
            <div class="h-100 d-md-flex justify-content-between align-items-center">
                <div class="email-address">
                    <a href="mailto:danangresidence@gmail.com">danangresidence@gmail.com</a>
                </div>

                <div class="phone-number d-flex">
                    <div class="icon">
                        <img src="{{asset('templates/house/')}}/img/icons/phone-call.png" alt="">
                    </div>
                    <div class="number">
                        <a href="tel:0798.739.286">0798.739.286</a>

                        <img class="logo_language" src="{{ asset('/public/templates/house/img/blog-img/vn.png') }}">
                            <a class="language" href="{{ url('language/vn') }}"><i style="margin-right: 1em;" class="fa fa-language"></i>VN</a>
                        <img class="logo_language" src="{{ asset('/public/templates/house/img/blog-img/en.png') }}">
                            <a class="language" href="{{ url('language/en') }}"><i style="margin-right: 1em;" class="fa fa-language"></i>EN</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Header Area -->
        <div class="main-header-area" id="stickyHeader">
            <div class="classy-nav-container breakpoint-off">
                <!-- Classy Menu -->
                <nav class="classy-navbar justify-content-between" id="southNav">

                    <!-- Logo -->
                    <a class="nav-brand" href="{{ route('house.index.index') }}"><img src="{{asset('templates/house/')}}//img/core-img/logo.png" alt=""></a>

                    <!-- Navbar Toggler -->
                    <div class="classy-navbar-toggler">
                        <span class="navbarToggler"><span></span><span></span><span></span></span>
                    </div>

                    <!-- Menu -->
                    <div class="classy-menu">

                        <!-- close btn -->
                        <div class="classycloseIcon">
                            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                        </div>

                        <!-- Nav Start -->
                        <div class="classynav">
                            <ul>
                                <li><a href="{{ route('house.index.index') }}">{{ __('message.HOME') }}</a></li>
                                <li><a href="{{ route('house.page.about') }}">{{ __('message.ABOUT') }}</a></li>
                                <li><a href="{{ route('house.blog.index') }}">{{ __('message.BLOG') }}</a></li>
                                <li><a href="#">{{ __('message.MENU') }}</a>
                                    <div class="megamenu">
                                    @foreach ($objChoose->chunk(1) as $chunk)
                                        <ul class="single-mega cn-col-3">
                                            @foreach ($chunk as $value)
                                                <li class="title_menu">
                                                    <a style="font-size: 1.5em;" href="{{ route('house.cat.choose_product',strtolower($value->name)) }}">@if (session::get('locale') == "en"){{$value->name}}@else{{$value->name_vn }}@endif </a>
                                                </li>
                                            @foreach ($objCollection as $product)
                                                @php
                                                    $arr = [
                                                        'name'  => str_slug ($product->name),
                                                        'name1' => strtolower($value->name),
                                                    ]
                                                @endphp
                                                 <li class="title_menu_parent"><a href="{{ route('house.cat.choose_collection',$arr) }}">@if (session::get('locale') == "en"){{$product->name }}@else{{$product->name_vn }}@endif</a>
                                                 </li>
                                            @endforeach
                                            @endforeach
                                        </ul>
                                    @endforeach
                                        <ul class="single-mega cn-col-3">
                                            <li class="title_menu">
                                                <a style="font-size: 1.5em;" href="{{ route('house.blog.project.index') }}">{{ __('message.PROJECT') }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li><a href="{{ route('house.contact.index') }}">{{ __('message.CONTACT') }}</a></li>
                            </ul>

                            <!-- Search Form -->
                            <div class="south-search-form">
                                <form action="{{ route('house.index.search')}}" method="get">
                                    <input type="search" required="" name="search" id="search" placeholder="Search Anything ...">
                                    <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                </form>
                            </div>

                            <!-- Search Button -->
                            <a href="#" class="searchbtn"><i class="fa" aria-hidden="true"></i></a>
                        </div>
                        <!-- Nav End -->
                    </div>
                </nav>
            </div>
        </div>
    </header>


    <aside id="sticky-social">
    <ul>
        <li><a href="https://www.facebook.com/residencedanang" class="entypo-facebook" target="_blank"><span>Facebook</span></a></li>
        <li><a href="#" class="entypo-twitter" target="_blank"><span>Twitter</span></a></li>
        <li><a href="#" class="entypo-gplus" target="_blank"><span>Google+</span></a></li>
        <li><a href="#" class="entypo-instagrem" target="_blank"><span>Instagram</span></a></li>
    </ul>
</aside>
