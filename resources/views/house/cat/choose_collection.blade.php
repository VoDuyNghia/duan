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
                            <select id="status" name="status">
                              <option selected>Default</option>
                              <option value="1">Mới nhất</option>
                              <option value="2">Price from high to low</option>
                              <option value="3">Price from low to high</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div id="content" class="row">
                @include('house.cat.ajax_product')
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="south-pagination d-flex justify-content-end">
                        <nav aria-label="Page navigation">
                            {{-- {{$objProduct->total()}} --}}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript">
      $("select[name='status']").change(function(){
            var status      = $(this).val();
            var choose      = {{ $id_choose }};
            var collection  = {{ $id_collection }};
            var token       = $("input[name='_token']").val();

            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ route('ajax_product') }}',
                type: 'GET',
                data: {
                    status      : status,
                    choose      : choose,
                    collection  : collection,
                },
                success: function(data){
                    $('#content').html(data.view);
                },
                error: function(data){
                    console.log(data.error);
                }
            });
      });
    </script>
@endsection
