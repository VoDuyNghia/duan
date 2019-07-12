@extends("templates.admin.master")
@section("content")
<div class="content-wrapper" style="min-height: 445px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Thêm Slider Trang Chủ
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.index.index') }}"><i class="fa fa-dashboard"></i>Admin</a></li>
            <li class="active">Thêm Slider Trang Chủ</li>
        </ol>
    </section>
    <div class="container" style="padding-top: 30px">
            <section class="content container-fluid">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Thêm Slider Trang Chủ</h3>
        </div>
        <div class="box-header">
           <div class="col-lg-12" style="padding-bottom:50px">
              <form action="{{ route('admin.slider.index.add') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                 <div class="row">
                    <div class="col-md-4">
                       	<div class="form-group">
                          	<label>Tên sản phẩm</label>
                          	<select class="form-control"name="product">
                          	@foreach ($objProduct as $value)
                          		<option value="{{$value->id}}">Mã: {{$value->id}} ---- {{ $value->name }}</option>
                          	@endforeach
                          </select>
                       	</div>
                       	<div class="form-group">
                          	<label>Trạng thái Slider</label>
	                          	<select class="form-control" name="active" id="active">
	                                <option value="">------ Xin chọn tình trạng slider ------ </option>
	                                @foreach ($objActive as $value)
	                                    <option value="{{$value->id}}" @if(old('active') == $value->id) selected @endif>{{ $value->name }}</option>
	                                @endforeach
	                            </select>
                       	</div>
                       	<div class="form-group">
                          	<label>Vị trí</label>
                          	<input class="form-control" type="number" value="{{ old('position') }}" min="1" name="position" placeholder="Nhập vị trí">
                       	</div>
					    <div class="form-group">
					        <label>Hình hiển thị ( max height : 400px )</label>
					        <input type="file" style="display:none" id="upload-input_1" name="image_detail123" accept="image/*">
					        <div id="upload_1" class="form-control drop-area">
					            <h3>Kéo & thả ảnh vào đây ! </h3>
					            <button type="button" class="btn btn-primary btn-sm " id="btn_select123">hoặc click vào đây để chọn ảnh !</button>
					            <div id="thumbnail123" ></div>
					        </div>
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