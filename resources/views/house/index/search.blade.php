@extends('templates.house.master')
@section('content')
    <section class="breadcumb-area bg-img" style="background-image: url(/public/templates/house/img/bg-img/hero1.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcumb-content">
                        <h3 class="breadcumb-title">{{ __('message.SEARCH_KEYWORD') }} <br/> {{ $key_word }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Breadcumb Area End ##### -->

    <section class="blog-area section-padding-100">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="single-blog-area mb-50">
                        {{ __('message.RESULT', ['result' => $objNews->total()]) }}
                    </div>
                    <!-- Single Blog Area -->
                    @forelse ($objNews as $value)
                    @php
                        $arr = [
                            'name' => str_slug($value->name),
                            'id'   => $value->id
                        ]
                    @endphp
                        <div class="single-blog-area mb-50">
                            <!-- Post Thumbnail -->
                            <div class="blog-post-thumbnail">
                                <img src="{{asset('/image/files/show_news/'.$value->image)}}" alt="{{ $value->name }}">
                            </div>
                            <!-- Post Content -->
                            <div class="post-content">
                                <!-- Date -->
                                <div class="post-date">
                                    <a href="#">{{ Carbon\Carbon::createFromTimestamp(strtotime($value->created_at))->diffForHumans() }} </a>
                                </div>
                                <!-- Headline -->
                                <a href="#" class="headline">
                                    {{ $value->name }}
                                    @if ($value->address <> null)
                                        <span style="text-transform: uppercase; color:red;font-weight: bold;">( {{ __('message.PROJECT') }} )</span>
                                    @else
                                        <span style="text-transform: uppercase; color:blue;font-weight: bold;">( {{ __('message.BLOG') }} )</span>
                                    @endif
                                </a>
                                <!-- Post Meta -->
                                <div class="post-meta">
                                    <p>By <a href="#">{{$value->user->name}}</a></p>
                                </div>
                                <p>{{ $value->detail }}</p>
                                <!-- Read More btn -->
                                @if ($value->address == null)
                                    <a href="{{ route('house.blog.detail',$arr) }}" class="btn south-btn">{{ __('message.READMORE') }}</a>
                                @else
                                    <a href="{{ route('house.blog.project.detail',$arr) }}" class="btn south-btn">{{ __('message.READMORE') }}</a>
                                @endif
                                
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>

                <div class="col-12 col-lg-4">
                    <div class="single-blog-area mb-50">
                        {{ __('message.RESULT', ['result' => $objProducts->total()]) }}
                    </div>
                    <div class="blog-sidebar-area">

                        @forelse ($objProducts as $value)
                        @php
                            $arr = [
                                'name' => str_slug($value->name),
                                'id'   => $value->id,
                            ]
                        @endphp
                        <div class="single-featured-property">
                            <!-- Property Thumbnail -->
                            <div class="property-thumb">
                                <a href="{{ route('house.product.index',$arr) }}">
                                    <img src="{{asset('/image/files/show_image/'.$value->image)}}" alt="{{ $value->name }}">
                                </a>
                                <div class="tag">
                                    <span>@if (session::get('locale') == "en"){{ $value->choose->name }}@else{{ $value->choose->name_vn }}@endif</span>
                                </div>
                                <div class="status">
                                    <span>@if (session::get('locale') == "en"){{ $value->status->name }}@else{{ $value->status->name_vn }}@endif</span>
                                </div>
                                <div class="list-price">
                                    <p>{{ $value->price }}</p>
                                </div>
                            </div>
                            <!-- Property Content -->
                            <div class="property-content">
                                <a href="{{ route('house.product.index',$arr) }}"><h5>@if (session::get('locale') == "en"){{ $value->name }}@else{{ $value->name_vn }}@endif</h5></a>
                                <h6 style="color:blue;font-weight: bold;">( {{ $value->code }} )</h6>
                                <p class="location"><img src="{{asset('templates/house/')}}/img/icons/location.png" alt="">
                                @if(session::get('locale') == "en")
                                    {{ Helpers::stripUnicode($value->address) }} St., {{ Helpers::stripUnicode($value->district->name) }} @if($value->district_id <> 9) district @else City @endif @if($value->district_id <> 9), Da Nang @endif
                                @else 
                                    Đường {{ $value->address }}, @if($value->district_id <> 9) quận @else Thành phố @endif {{ $value->district->name }} @if($value->district_id <> 9), Đà Nẵng @endif 
                                @endif
                                </p>
                                <p>{{ $value->detail }}</p>
                                @if($value->configuration <> null && $value->configuration_vn <> null)
                                <div class="property-meta-data d-flex align-items-end justify-content-between">
                                    @if(json_decode($value->configuration, true))
                                    <?php
                                      $configurations = json_decode($value->configuration, true);
                                      ?>
                                    @endif
                                    @forelse($configurations as $key=>$value)
                                        @if ($key == 0)
                                            <div class="bathroom">
                                                <img src="{{asset('templates/house/')}}/img/icons/bathtub.png" alt="">
                                                <span>{{ $key }}</span>
                                            </div>
                                        @elseif($key ==1)
                                            <div class="garage">
                                                <img src="{{asset('templates/house/')}}/img/icons/garage.png" alt="">
                                                <span>{{ $key }}</span>
                                            </div>
                                        @elseif($key==2)
                                            <div class="space">
                                                <img src="{{asset('templates/house/')}}/img/icons/space.png" alt="">
                                                <span>{{ $key }} {{ __('message.S') }}</span>
                                            </div> 
                                        @endif
                                    @empty
                                    @endforelse
                                </div>
                                @endif
                            </div>
                        </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <!-- Pagination -->
                    <div class="south-pagination mt-100 d-flex">
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <li>{{ $objNews->appends(request()->input())->links() }}</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style type="text/css">
        .property-content{
            margin-bottom:2em;
        }

        .mb-50 {
            margin-bottom: 20px;
        }
    </style>

@endsection