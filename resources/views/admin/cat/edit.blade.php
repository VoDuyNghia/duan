@extends("templates.admin.master")
@section("content")
<div class="content-wrapper" style="min-height: 445px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Sửa danh mục
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.index.index') }}"><i class="fa fa-dashboard"></i>Admin</a></li>
            <li class="active">Sửa danh mục</li>
        </ol>
    </section>
    <div class="container" style="padding-top: 30px">
            <section class="content container-fluid">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Sửa danh mục</h3>
        </div>
        <div class="box-header">
           <div class="col-lg-12" style="padding-bottom:50px">
              <form action="{{ route('admin.cat.edit',$objItem['id']) }}" method="POST">
                {{ csrf_field() }}
                 <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                          <label>Tên danh mục (EN) </label>
                          <input class="form-control" type="text" value="{{ $objItem['name'] }}" name="name_category" placeholder="Nhập tên danh mục EN">
                        </div>
                        <div class="form-group">
                          <label>Tên danh mục (VN) </label>
                          <input class="form-control" type="text" value="{{ $objItem['name_vn'] }}" name="name_category_vn" placeholder="Nhập tên danh mục VN">
                        </div>
                       <div class="form-group">
                          <label>Vị trí</label>
                          <input class="form-control" type="number" value="{{ $objItem['position'] }}" name="position" placeholder="Nhập vị trí">
                       </div>
                    </div>
                    <div style='text-align: center;font-size: 30px;text-transform: uppercase;color: red;font-weight: bold;' class="col-md-8">
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
                    <button type="submit" class="btn btn-success">Sửa</button>
                    <button type="reset" class="btn btn-default">Làm lại</button>
                 </div> <br/>

                 <div class="text-center">
                      <a class="btn btn-info" href="{{ route('admin.cat.index') }}">QUAY LẠI</a>
                    </div>
              </form>
           </div>
        </div>
    </div>
</section>
    </div>
</div>
@endsection