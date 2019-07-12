@extends("templates.admin.master")
@section("content")
<div class="content-wrapper" style="min-height: 445px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Sửa Blogs Mã {{ $objNews['id'] }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.index.index') }}"><i class="fa fa-dashboard"></i>Admin</a></li>
            <li class="active">Sửa Blogs Mã {{ $objNews['id'] }}</li>
        </ol>
    </section>
    <div class="container" style="padding-top: 30px">
	<section class="content container-fluid">
	    <div class="box">
	        <div class="box-header">
	            <h3 class="box-title">Sửa Blogs Mã {{ $objNews['id'] }}</h3>
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
				<form action="{{ route('admin.news.edit',[$objNews['id']]) }}" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">  
					{{ csrf_field() }}
					<div class="row setup-content" id="step-1">       
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
								  <label>Tiêu đề</label>
								  <input class="form-control" type="text" name="name" placeholder="Xin nhập tên sản phẩm" value="{{ $objNews['name'] }}">
								</div>
							   	<div class="form-group">
						            <label>Chi tiết</label>
						            <textarea class="form-control" name="detail" id="detail">{{ $objNews['detail'] }}</textarea>
						        </div>

	                            <div class="form-group">
	                              <label>Tình trạng bài viết</label>
	                                <select class="form-control" name="active" id="active">
	                                    <option value="">------ Xin chọn tình trạng bài viết ------ </option>
	                                    @foreach ($objActive as $value)
	                                        <option value="{{$value->id}}" @if($value->id == $objNews['active_id']) selected @endif>{{$value->name}} </option>
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
								            <div id="thumbnail123" >
								            	<span>Ảnh cũ</span> <br/>
								            	<img style='width: 100px;height: 100px;margin: 5px;' class="img-thumbnail123" src="{{asset('image/files/show_news/'.$objNews['image'])}}"/>
								            </div>
								        </div>
								    </div>
								</div>
                                <div class="col-md-6">
                                	@if ($objNews['address'] <> '')
                                    <div class="form-group">
                                        <label>Thể loại đăng bài</label>
                                        
	                                        <select onchange="myChange('{{$objNews['address']}}')" class="form-control" name="choose" id="choose">
	                                            <option value="1">Blogs</option>
	                                            <option selected="" value="2">Dự án</option>
	                                        </select>
                                    </div>
                                    <div id="address_info" class="form-group">
                                    	<div id="address"><label>Địa chỉ(EN)</label> <input type="text" name="address" class="form-control" placeholder="Vui lòng nhập địa chỉ" value="{{ $objNews['address'] }}"></div>

                                        <div id="address_vn"><label>Địa chỉ(VN)</label> <input type="text" name="address_vn" class="form-control" placeholder="Vui lòng nhập địa chỉ" value="{{ $objNews['address_vn'] }}"></div>

                                    </div>
                                    @endif
                                </div>
							</div>
						</div>
						<div class="col-md-12">
						    <div class="form-group">
						        <label>Mô tả</label>
						        <textarea class="form-control"  name="description">{{ $objNews['content'] }}</textarea>
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
                                  <input class="form-control" type="text" name="name_vn" placeholder="Xin nhập tên sản phẩm" value="{{ $objNews['name_vn'] }}">
                                </div>
                                <div class="form-group">
                                    <label>Chi tiết (VN)</label>
                                    <textarea class="form-control" name="detail_vn" id="detail_vn">{{ $objNews['detail_vn'] }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Mô tả (VN)</label>
                                    <textarea class="form-control" name="description_vn">{{ $objNews['content_vn'] }}</textarea>
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