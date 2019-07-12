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
                <div class="col-12">
                    <div class="listings-top-meta d-flex justify-content-between mb-100">
                        <div class="view-area d-flex align-items-center">
                        </div>
                        <div class="order-by-area d-flex align-items-center">
                            <span class="mr-15">Order by:</span>
                            <select id="status" onchange="callAjax()" id="choose">
                              <option selected>Default</option>
                              <option value="1">Mới nhất</option>
                              <option value="2">Mua</option>
                              <option value="3">Cho Thuê</option>
                              <option value="4">Price from high to low</option>
                              <option value="5">Price from low to high</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div id="content" class="row">
            	@forelse ($objProduct as $value)
	            @php
	                $arr = [
	                    'name' => str_slug($value->title),
	                    'id'   => $value->id_title,
	                ]
	            @endphp
	                @include('house.cat.ajax_product')
	            @empty
	                <div class="col-12 col-md-6 col-xl-4">
	                    Không có sản phẩm
	                </div>
	            @endforelse

            </div>
            <div class="row">
                <div class="col-12">
                    <div class="south-pagination d-flex justify-content-end">
                        <nav aria-label="Page navigation">
                            {{$objProduct->total()}}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
