@extends("templates.admin.master")
@section("content")
<div class="content-wrapper" style="min-height: 445px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Thêm Blogs
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.index.index') }}"><i class="fa fa-dashboard"></i>Admin</a></li>
            <li class="active">Thêm Blogs</li>
        </ol>
    </section>
    <div class="container" style="padding-top: 30px">
    <section class="content container-fluid">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Thêm Blogs</h3>
            </div>
            <div class="stepwizard col-md-offset-2">
                <div class="stepwizard-row setup-panel">
                  <div class="stepwizard-step">
                    <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                    <p>Step 1</p>
                  </div>
                  <div class="stepwizard-step">
                    <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                    <p>Step 2</p>
                  </div>
                </div>
            </div>
            <div class="box-header">
                <div class="col-lg-12" style="padding-bottom:50px">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li> {{ $error }} </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('admin.news.add') }}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">  
                    {{ csrf_field() }} 
                    <div class="row setup-content" id="step-1">         
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                  <label>Tiêu đề (EN)</label>
                                  <input class="form-control" type="text" name="name" placeholder="Xin nhập tên sản phẩm" value="{{ old('name') }}">
                                </div>
                                <div class="form-group">
                                    <label>Chi tiết (EN)</label>
                                    <textarea class="form-control" name="detail" id="detail">{{ old('detail')}}</textarea>
                                </div>
                                <div class="form-group">
                                  <label>Tình trạng bài viết</label>
                                    <select class="form-control" name="active" id="active">
                                        <option value="">------ Xin chọn tình trạng bài viết ------ </option>
                                        @foreach ($objActive as $value)
                                            <option value="{{$value->id}}" @if(old('active') == $value->id) selected @endif>{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Hình đại diện ( 754 x 357 )</label>
                                        <input type="file" style="display:none" id="upload-input_1" name="image_detail123" accept="image/*">
                                        <div id="upload_1" class="form-control drop-area">
                                            <h3>Kéo & thả ảnh vào đây ! </h3>
                                            <button type="button" class="btn btn-primary btn-sm " id="btn_select123">hoặc click vào đây để chọn ảnh !</button>
                                            <div id="thumbnail123" ></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Thể loại đăng bài</label>
                                        <select onchange="myChange()" class="form-control" name="choose" id="choose">
                                            <option value="1">Blogs</option>
                                            <option value="2">Dự án</option>
                                        </select>
                                    </div>
                                    <div id="address_info" class="form-group">
                                    </div>

                                    <div id="address_info_vn" class="form-group">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <script type="text/javascript">
                            function myChange() {
                                x = document.getElementById("choose").value;
                                if(x == 1) {
                                   $("#address").remove();
                                   $("#address_vn").remove();
                                }else {
                                    $("#address_info").append('<div id="address"><label>Địa chỉ (EN)</label> <input type="text" name="address" class="form-control" placeholder="Vui lòng nhập địa chỉ"></div>');
                                    $("#address_info_vn").append('<div id="address_vn"><label>Địa chỉ(VN)</label> <input type="text" name="address_vn" class="form-control" placeholder="Vui lòng nhập địa chỉ"></div>');
                                }
                               
                            }
                        </script>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Mô tả (EN)</label>
                                <textarea class="form-control"  name="description">{{ old('description') }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div style="text-align: center;" class="col-md-12">
                                <button class="btn btn-primary nextBtn btn-lg" type="button" >Next</button>
                            </div>
                        </div>
                    </div>
                    <div class="row setup-content" id="step-2">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                  <label>Tiêu đề (VN )</label>
                                  <input class="form-control" type="text" name="name_vn" placeholder="Xin nhập tên sản phẩm" value="{{ old('name_vn') }}">
                                </div>
                                <div class="form-group">
                                    <label>Chi tiết (VN)</label>
                                    <textarea class="form-control" name="detail_vn" id="detail_vn">{{ old('detail_vn')}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Mô tả (VN)</label>
                                    <textarea class="form-control" name="description_vn">{{ old('description_vn') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success PreviousBtn btn-lg">Lưu</button>
                            <button class="btn btn-primary PreviousBtn btn-lg" type="button" >Previous Step 1</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    </div>
</div>
@endsection