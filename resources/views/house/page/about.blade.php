@extends('templates.house.master')
@section('content')

<!-- ##### Hero Area End ##### -->
@include('templates.house.banner')
<!-- ##### Advance Search Area Start ##### -->
<div class="south-search-area">
    @include("templates.house.fitter")
</div>
<!-- ##### Call To Action Area Start ##### -->
    <section class="listings-content-wrapper section-padding-100">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="section-heading text-left wow fadeInUp" data-wow-delay="250ms">
                        <h2>@if (session::get('locale') == "en"){{ $objPages['name'] }}@else{{ $objPages['name_vn'] }}@endif</h2>
                    </div>
                    <div class="about-content">
                    @if (session::get('locale') == "en"){!! $objPages['content'] !!}@else{!! $objPages['content_vn'] !!}@endif
                    </div>
                </div>
                @include('templates.house.left_bar')
            </div>
        </div>
    </section>
    @include('templates.house.describe')
@endsection
