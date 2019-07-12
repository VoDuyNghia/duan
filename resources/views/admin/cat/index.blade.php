@extends("templates.admin.master")
@section("content")
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Danh Mục
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.index.index') }}"><i class="fa fa-dashboard"></i> Trang Chủ</a></li>
        <li class="active">Danh Mục</li>
      </ol>
    </section>



    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Danh Sách Mục Lục</h3>
            </div>
  
            <div id="notify_success" class=" notify success">
              @if (Session::has('msg'))
                <div class="alert alert-success">{{ Session::get('msg') }}</div>
              @endif
            </div>

            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th class="text-center"> ID</th>
                  <th class="text-center"> Tên Danh Mục (EN)</th>
                  <th class="text-center"> Tên Danh Mục (VN)</th>
                  <th class="text-center"> Vị Trí</th>
                  <th class="text-center">
                      <a href="{{ route('admin.cat.add') }}" class="btn btn-primary btn-xs">Thêm Danh Mục</a>
                  </th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($objCollection as $value)
                    <tr id="delete-coloum-{{$value->id}}">
                      <td class="text-center">{{ $value->id }}</td>
                      <td class="text-center">{{ $value->name}}</td>
                      <td class="text-center">{{ $value->name_vn}}</td>
                      <td class="text-center">{{ $value->position}}</td>
                      <td class="text-center">
                          <a href="{{ route('admin.cat.edit',[$value->id ]) }}" class="btn btn-warning btn-xs edit-category">Sửa</a> || 
                          <button class="btn btn-danger btn-xs" id="delete-category" value="{{$value->id}}">Xóa</button>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th class="text-center"> ID</th>
                  <th class="text-center"> Tên Danh Mục (EN)</th>
                  <th class="text-center"> Tên Danh Mục (VN)</th>
                  <th class="text-center"> Vị Trí</th>
                  <th class="text-center"> Chức Năng</th>
                  <th></th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!-- /.col -->
      </div>

    <div class="modal modal-danger fade" id="modal-danger">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Bạn có muốn xóa Danh mục này không ? </h4>
                </div>
                <div class="modal-footer" id="add-body">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-outline" id="delete-save" data-id="">Xóa</button>
                   
                </div>
            </div>
        </div>
    </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <script>
    $("body").on('click','#delete-category',function(){
        var value = $(this).val();
        $('#modal-danger').modal('show');
        $('#delete-save').attr('data-id',value);
    });

    $('#delete-save').on('click',function(){
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
        });

        var id = $(this).attr('data-id');
        var state = $(this).val();
        
        $.ajax({
            url : '{{route('delete_category')}}',
            type : 'GET',
            data : {
                id : id
        },
        success:function(data){
            $("#delete-coloum-"+id).replaceWith();
            $('#modal-danger').modal('hide');
            
            if(data.success){
                $('#notify_success').html('<div class=" notify success"><div class="alert alert-success">' + data.success + '</div></div>');
                setTimeout(function(){location.href='{{ route('admin.cat.index') }}';},2000);
            }else{
                $('#notify_success').html('<div class=" notify error"><div class="alert alert-danger">' + data.error + '</div></div>');
                setTimeout(function(){location.href='{{ route('admin.cat.index') }}';},2000);
            }
        }
        });
    })
  </script>
 
  <!-- /.content-wrapper -
@endsection