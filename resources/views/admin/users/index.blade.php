@extends("templates.admin.master")
@section("content")
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Thành viên
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.index.index') }}"><i class="fa fa-dashboard"></i> Trang Chủ</a></li>
        <li class="active">Thành viên</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Danh Sách Thành viên</h3>
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
                  <th class="text-center"> Họ và tên</th>
                  <th class="text-center"> Email</th>
                  <th class="text-center"> Mật khẩu</th>
                  <th class="text-center">
                      <a href="{{ route('admin.users.add') }}" class="btn btn-primary btn-xs">Thêm Tài Khoản</a>
                  </th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($objUsers as $value)
                    <tr data-id="{{ $value->id }}">
                      <td class="text-center">{{ $value->id }}</td>
                      <td>{{ $value->name}}</td>
                      <td >{{ $value->email}}</td>
                      <td>
                          <div class="row">
                             <div class="col-sm-3">
                                 <button class="btn btn-warning btn-xs pw-reset" style="margin:2px !important; padding:5px !important">
                                     <i class="fa fa-lock fa-fw"></i><span class="text-pw">Reset</span>
                                 </button>
                             </div>
                              <div class="col-sm-6">
                                  <input name='password' type="password" class="form-control none-style pl-0"  readonly value="password" >
                              </div>
                          </div>
                      </td>
                      <td  id="trangthai_{{$value->id}}" class="text-center">
                          <div class="row">
                              @if ($value->active == 0)
                                <a onclick="chuyenTrangThai({{$value->id}},{{ $value->active }})" href="javascript:void()">
                                  <img src="http://event.titans.mu/event/image/deactive.gif">
                                </a>
                              @else
                                <a onclick="chuyenTrangThai({{$value->id}},{{ $value->active }})" href="javascript:void()">
                                  <img src="http://event.titans.mu/event/image/active.gif">
                                </a>
                              @endif
                          </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th class="text-center"> ID</th>
                  <th class="text-center"> Họ và tên</th>
                  <th class="text-center"> Email</th>
                  <th class="text-center"> Mật khẩu</th>
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
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

  <script>

    function chuyenTrangThai(id,active) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        url: '{{ route('active_user') }}',
        type: 'POST',
        cache: false,
        data: {id:id , active:active },
        success: function(data){
          if(data.success){
              $('#notify_success').html('<div class=" notify success"><div class="alert alert-success">' + data.success + '</div></div>');
              setTimeout(function(){location.href='{{ route('admin.users.index') }}';},2000);
          }else{
              $('#notify_success').html('<div class=" notify error"><div class="alert alert-danger">' + data.error + '</div></div>');
              setTimeout(function(){location.href='{{ route('admin.users.index') }}';},2000);
          }
        },
        error: function (){
          alert('Có lỗi xảy ra');
        }
      });
    }
  



    $(document).on('click','.pw-reset',function(){
        $(this).find('span.text-pw').text('Save');
        $(this).closest('tr').find('input[type=password]')
                .removeAttr('readonly')
                .attr({'type' : 'text', 'autofocus' : true })
                .val('');
        $(this).removeClass('btn-warning').addClass('btn-success').attr('id','save');
    }).on('click','#save',function(){
          $(this).removeClass('btn-success').addClass('btn-warning').removeAttr('id');
          $(this).find('span.text-pw').text('Reset');
          var tr = $(this).closest('tr');
          var ipt_password = tr.find('input[name=password]');
          var id = tr.attr('data-id');
          var password = ipt_password.val();

          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });


          $.ajax({
              url : '{{ route('change_pass') }}',
              type : 'POST',
              data : {
                  id : id,
                  password : password,  
              },
              success : function(data){
                  if(data.success){
                      $('#notify_success').html('<div class=" notify success"><div class="alert alert-success">' + data.success + '</div></div>');
                      setTimeout(function(){location.href='{{ route('admin.users.index') }}';},2000);

                  }else{
                      $('#notify_success').html('<div class=" notify error"><div class="alert alert-danger">' + data.error + '</div></div>');
                      setTimeout(function(){location.href='{{ route('admin.users.index') }}';},2000);
                  }
              }
          });
          ipt_password.attr({'type' : 'password', 'readonly' : 'readonly'});
    })
  </script>
 
  <!-- /.content-wrapper -
@endsection