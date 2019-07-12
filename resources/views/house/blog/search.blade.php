@extends('templates.house.master')
@section('content')
    <section class="breadcumb-area bg-img" style="background-image: url(/public/templates/house/img/bg-img/hero1.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcumb-content">
                        <h3 class="breadcumb-title" style="word-break: break-word;">TÌM KIẾM BLOGS VỚI TỪ KHÓA <br/>{{ $key_word }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Breadcumb Area End ##### -->
    <section class="south-blog-area section-padding-100">
        <div class="container">
            <div class="single-blog-area mb-50">
                Có {{$objNews->total()}} blogs cần tìm
            </div>
            @include('house.blog.blog')
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
@endsection