<section class="hero-area">
    <div class="hero-slides owl-carousel">
        <!-- Single Hero Slide -->
        @foreach ($SliderIndex as $value)
        @php
            $image = "/public/image/files/slider_index/".$value->image;
            $arr = [
                'name' => str_slug($value->product->name),
                'id'   => $value->product->id
            ]
        @endphp
        <div class="single-hero-slide bg-img" style="background-image: url({{ $image }});">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12">
                        <div class="hero-slides-content">
                            <a href="{{ route('house.product.index',$arr) }}">
                            <h2 data-animation="fadeInUp" data-delay="100ms">@if (session::get('locale') == "en"){{ $value->product->name }}@else{{ $value->product->name_vn }}@endif</h2>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>