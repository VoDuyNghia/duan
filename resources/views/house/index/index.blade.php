@extends('templates.house.master')
@section('content')

@include('templates.house.banner')
<!-- ##### Hero Area End ##### -->

<!-- ##### Advance Search Area Start ##### -->
<div class="south-search-area">
    @include("templates.house.fitter")
</div>
<!-- ##### Advance Search Area End ##### -->

<!-- ##### Featured Properties Area Start ##### -->
<section class="featured-properties-area section-padding-100-50">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading wow fadeInUp">
                    <h2>{{ __('message.PRODUCT') }}</h2>
                </div>
            </div>
        </div>
        <div id="content" class="row">
            @include('house.cat.ajax_product')
        </div>
    </div>
</section>
<!-- ##### Featured Properties Area End ##### -->

<!-- ##### Editor Area Start ##### -->
@endsection
