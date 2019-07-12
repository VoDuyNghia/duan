@extends("templates.admin.master")
@section("content")
<div class="content-wrapper" style="min-height: 445px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Thêm Sản phẩm
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.index.index') }}"><i class="fa fa-dashboard"></i>Admin</a></li>
            <li class="active">Thêm Sản phẩm</li>
        </ol>
    </section>
    <div class="container" style="padding-top: 30px">
	<section class="content container-fluid">
	    <div class="box">
	        <div class="box-header">
	            <h3 class="box-title">Thêm sản phẩm</h3>
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
                @if ($errors->any() or Session::has('msg') )
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li> {{ $error }} </li>
                                <li> {{ Session::get('msg') }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
				<form action="{{ route('admin.product.add') }}" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">  
					{{ csrf_field() }}  
                    <div class="row setup-content" id="step-1">        
    					<div class="row">
    						<div class="col-md-4">
                                <div class="form-group">
                                  <label>Thể loại</label>
                                    <select class="form-control" name="choose_id" id="choose">
                                    <option value="">Xin chọn thể loại</option>
                                        @foreach ($objChoose as $value)
                                            {{-- <option value="{{$value->id}}">{{ $value->name }}</option> --}}
                                            <option value="{{$value->id}}" @if(old('choose_id') == $value->id) selected @endif>
                                                {{$value->name}} 
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

    				            <div class="form-group">
    						      <label>Danh Mục</label>
    						        <select class="form-control" name="collection_id" id="collection">
    						        <option value="">Xin chọn danh mục..</option>
    				                    @foreach ($objCollection as $value)
                                            <option value="{{$value->id}}" @if(old('collection_id') == $value->id) selected @endif>
                                                {{$value->name}} 
                                            </option>
    						            @endforeach
    						        </select>
    						   	</div>
                                <div class="form-group">
                                  <label>Mã sản phẩm</label>
                                  <input class="form-control" type="text" name="code" placeholder="Xin nhập mã sản phẩm" value="{{ old('code') }}">
                                </div>
    				            <div class="form-group">
    						      <label>Tiêu đề (EN )</label>
    						      <input class="form-control" type="text" name="name" placeholder="Xin nhập tên sản phẩm" value="{{ old('name') }}">
    				            </div>
    				            <div class="form-group">
    					            <label>Chi tiết (EN)</label>
    					            <textarea class="form-control" name="detail" id="detail">{{ old('detail')}}</textarea>
    					        </div>
                       
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <label>Phòng tắm</label>
                                        <input class="form-control" type="number" name="bedrooms" value="{{ old('bedrooms') }}"  id="bedrooms" placeholder="Số lượng phòng tắm" min="0" max="999999999999">
                                    </div>

                                    <div class="col-md-4">
                                        <label>Phòng ngủ</label>
                                        <input class="form-control" type="number" value="{{ old('bathrooms') }}" name="bathrooms" id="bathrooms" placeholder="Số lượng phòng ngủ" min="0" max="999999999999">
                                    </div>

                                    <div class="col-md-4">
                                        <label>Diện tích</label>
                                        <input class="form-control" type="text" name="sqrt" value="{{ old('sqrt') }}" id="sqrt" placeholder="Diện tích" min="0" max="999999999999">
                                    </div>
                                </div>

    						    <div class="form-group">
    						        <label>Thông số (EN)</label>
    						        <table class="table configuration">
    						        </table>
    						        <button id="btn_add_columns" type="button" class="btn btn-sm btn-primary pull-left">
    						            <span class="glyphicon glyphicon-plus"></span>&nbsp;Thêm
    						        </button>
    						    </div>
    						</div>
    						<div class="col-md-8">
    							<div class="col-md-12">
    							    <div class="form-group">
    							        <label>Hình ảnh Mô tả ( 1200 x 604)</label>
    							        <input type="file" style="display:none" id="upload-input" multiple="multiple" name="image_detail[]" accept="image/*">
    							        <div id="upload" class="form-control drop-area">
    							            <h3>Kéo & thả ảnh vào đây ! </h3>
    							            <button type="button" class="btn btn-primary btn-sm " id="btn_select">hoặc click vào đây để chọn ảnh !</button>
    							            <div id="thumbnail" ></div>
    							        </div>
    							    </div>
    						 	</div>
    					    	<div class="col-md-6">
    							    <div class="form-group">
    							        <label>Hình đại điện (1000 x 724)</label>
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
                                      <label>Quận</label>
                                        <select class="form-control" name="district_id" id="district">
                                        <option value="">------ Xin chọn quận ------ </option>
                                            @foreach ($objDistrict as $value)
                                                @php
                                                    if (old('district_id') ==$value->id ) {
                                                        $selected = 'selected';
                                                    } else {
                                                        $selected = '';
                                                    }
                                                @endphp
                                                <option {{ $selected }} value="{{$value->id}}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                      <label>Địa chỉ</label>
                                      <input class="form-control" type="text" name="address" placeholder="Xin nhập địa chỉ" value="{{ old('address') }}">
                                    </div>

                                    <div class="form-group">
                                      <label>Giá tiền</label>
                                      <input class="form-control" type="number" step="0.01" name="price" placeholder="Xin nhập giá" value="{{ old('price') }}">
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

                                    <div class="form-group">
                                      <label>Tình trạng sản phẩm</label>
                                        <select class="form-control" name="status_id" id="status_id">
                                            <option value="">------ Xin chọn tình trạng sản phẩm------ </option>
                                            @foreach ($objStatus as $value)
                                                <option value="{{$value->id}}" @if(old('status_id') == $value->id) selected @endif>{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                </div>
    						</div>
    					</div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Mô tả (EN)</label>
                                    <textarea class="form-control"  name="description">{{ old('description') }}</textarea>
                                </div>
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

                                <div class="form-group">
                                    <label>Thông số (VN)</label>
                                    <table class="table configuration_vn">
                                    </table>
                                    <button id="btn_add_columns_vn" type="button" class="btn btn-sm btn-primary pull-left">
                                        <span class="glyphicon glyphicon-plus"></span>&nbsp;Thêm
                                    </button>
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