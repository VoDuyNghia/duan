<div class="row">
    <div id="content" class="col-12 col-lg-8">
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
                    <a href="#" class="headline">@if (session::get('locale') == "en"){{ $value->name }}@else{{ $value->name_vn }}@endif</a>
                    <!-- Post Meta -->
                    <div class="post-meta">
                        <p>By <a href="#">{{$value->user->name}}</a></p>
                    </div>
                    <p>@if (session::get('locale') == "en"){{ $value->detail }}@else{{ $value->detail_vn }}@endif</p>
                    <!-- Read More btn -->
                    <a href="{{ route('house.blog.detail',$arr) }}" class="btn south-btn">{{ __('message.READMORE') }}</a>
                </div>
            </div>
        @empty
        @endforelse
    </div>
    @include('templates.house.left_bar')
</div>