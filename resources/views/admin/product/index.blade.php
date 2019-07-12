@extends("templates.admin.master")
@section("content")
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sản phẩm
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.index.index') }}"><i class="fa fa-dashboard"></i> Trang Chủ</a></li>
        <li class="active">Sản phẩm</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Quản lý sản phẩm</h3>
            </div>
            
            <div class="form-group">
              <fieldset class="scheduler-border">
                  <legend class="scheduler-border">Bộ lọc</legend>
                  <div class="row control-group">
                      <div class="col-sm-4 form-group">
                          <label for="">Thời gian</label>
                          <div class="input-group">
                              <div class="input-group-addon">
                                  <i class="fa fa-clock-o"></i>
                              </div>
                              <input id='daterange' class="form-control pull-right" type="text" name="datetimes" />
                          </div>
                      </div>
                      <div class="col-sm-3 form-group">
                          <label for="">Search</label>
                          <input style='width: 100%' type="text" class="form-control" id="search" placeholder="Nhập từ khóa" value="">
                      </div>
                      <div class="col-sm-3 form-group">
                          <label for="">Danh Mục</label>
                          <select class="form-control" name="category" id="category">
                            <option value="">Lựa chọn danh mục</option>
                            @foreach ($objCollection as $value)
                              <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                          </select>
                      </div>


                      <div class="col-sm-2 form-group">
                          <label for="">Tình Trạng</label>
                          <select class="form-control" name="status" id="status">
                            <option value="">Tình Trạng</option>
                            <option value="1">Ẩn</option>
                            <option value="2">Hiển Thị</option>
                          </select>
                      </div>
                  </div>
              </fieldset>
            </div>
  
            <div id="notify_success" class=" notify success">
              @if (Session::has('msg'))
                <div class="alert alert-success">{{ Session::get('msg') }}</div>
              @endif
            </div>

            <!-- /.box-header -->
            <div id="content" class="box-body">
                @include('admin.ajax.ajax_product')
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <div class="modal modal-danger fade" id="modal-danger">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Bạn có muốn xóa Sản phẩm này không ?</h4>
                </div>
                <div class="modal-footer" id="add-body">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-outline" id="delete-save" data-id="">Xóa</button>


                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
  </div>

  <script>
      function callAjax(){
        var date_start = $('input[name=daterangepicker_start]').val();
        var date_end   = $('input[name=daterangepicker_end]').val();
        var search     = $('#search').val();
        var status     = $('#status').val();
        var category   = $('#category').val();
        $.ajax({
            url : '{{route('ajax_product')}}',
            type : 'GET',
            data : {
                date_start  : date_start,
                date_end    : date_end,
                search      : search,
                status      : status,
                category    : category,
            },
            success:function(data){
                $('#content').html(data.view);
            }
        });
    };
    
    $("body").on('click','#delete-product',function(){
        var value = $(this).val();
        $('#modal-danger').modal('show');
        $('#delete-save').attr('data-id',value);
    });

    $('#delete-save').on('click',function(){
      var id = $(this).attr('data-id');

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
          url : '{{ route('delete_product') }}',
          type : 'POST',
          data : {
              id : id,
          },
          success : function(data){
              $("#delete-coloum-"+id).replaceWith();
              $('#modal-danger').modal('hide');

              if(data.success){

                  $('#notify_success').html('<div class=" notify success"><div class="alert alert-success">' + data.success + '</div></div>');
                  setTimeout(function(){location.href='{{ route('admin.product.index') }}';},2000);

              }else{
                  $('#notify_success').html('<div class=" notify error"><div class="alert alert-danger">' + data.error + '</div></div>');
                  setTimeout(function(){location.href='{{ route('admin.product.index') }}';},2000);
              }
          }
      });
    })
  </script>
 
  <!-- /.content-wrapper -
@endsection