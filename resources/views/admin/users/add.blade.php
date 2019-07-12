@extends("templates.admin.master")
@section("content")
<div class="content-wrapper" style="min-height: 445px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Thêm tài khoản
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.index.index') }}"><i class="fa fa-dashboard"></i>Admin</a></li>
            <li class="active">Thêm tài khoản</li>
        </ol>
    </section>
    <div class="container" style="padding-top: 30px">
            <section class="content container-fluid">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Thêm tài khoản</h3>
        </div>
        <div class="box-header">
           <div class="col-lg-12" style="padding-bottom:50px">
              <form action="{{ route('admin.users.add') }}" method="POST">
                {{ csrf_field() }}
                 <div class="row">
                    <div class="col-md-4">
                       <div class="form-group">
                          <label>Họ và tên</label>
                          <input class="form-control" type="text" value="{{ old('username') }}" name="username" placeholder="Nhập họ và tên">
                       </div>
                       <div class="form-group">
                          <label>Email</label>
                          <input class="form-control" type="email" value="{{ old('email') }}" name="email" placeholder="Nhập email">
                       </div>

                      <div class="form-group">
                          <label>Password</label>
                          <input class="form-control" type="password" value="{{ old('password') }}" min="1" name="password" placeholder="Nhập mật khẩu">
                       </div>
                    </div>
                    <div style='font-size: 20px;text-transform: uppercase;color: red;font-weight: bold;' class="col-md-8">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li> {{ $error }} </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (Session::has('msg'))
                            <div class="alert alert-danger">
                                <ul>
                                    {{ Session::get('msg') }}
                                </ul>
                            </div>
                        @endif
                    </div>
                 </div>
                 <div class="text-center">
                    <button type="submit" class="btn btn-success">Thêm</button>
                    <button type="reset" class="btn btn-default">Làm lại</button>
                 </div>
              </form>
           </div>
        </div>
    </div>
</section>
    </div>
</div>
@endsection