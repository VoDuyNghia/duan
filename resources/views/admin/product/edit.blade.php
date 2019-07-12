@extends("templates.admin.master")
@section("content")
<div class="content-wrapper" style="min-height: 445px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Sửa Sản phẩm
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.index.index') }}"><i class="fa fa-dashboard"></i>Admin</a></li>
            <li class="active">Sửa Sản phẩm</li>
        </ol>
    </section>
    <div class="container" style="padding-top: 30px">
	<section class="content container-fluid">
	    <div class="box">
	        <div class="box-header">
	            <h3 class="box-title">Sửa sản phẩm</h3>
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
                @if (Session::has('msg'))
                        <div class="alert alert-danger">
                            <ul>
                                <li>{{ Session::get('msg') }}</li>
                            </ul>
                        </div>
                @endif
                <form action="{{ route('admin.product.edit',[$objProduct['id']]) }}" method="POST" enctype="multipart/form-data">
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
                                          <option value="{{$value->id}}" @if($value->id == $objProduct['choose_id']) selected @endif>{{$value->name}} </option>
                                      @endforeach
                                  </select>
                              </div>

                             <div class="form-group">
                                <label>Danh Mục</label>
                                  <select class="form-control" name="collection_id" id="collection">
                                  <option value="">Xin chọn danh mục..</option>
                                      @foreach ($objCollection as $value)
                                          <option value="{{$value->id}}" @if($value->id == $objProduct['collection_id']) selected @endif>{{$value->name}} </option>
                                      @endforeach
                                  </select>
                              </div>
                              <div class="form-group">
                                  <label>Mã sản phẩm</label>
                                  <input class="form-control" type="text" name="code" placeholder="Xin nhập mã sản phẩm" value="{{ $objProduct['code'] }}">
                                </div>

                              <div class="form-group">
                                <label>Tiêu đề (EN)</label>
                                <input class="form-control" type="text" name="name" placeholder="Xin nhập tên sản phẩm" value="{{ $objProduct['name'] }}">
                              </div>
                              <div class="form-group">
                                  <label>Chi tiết (EN)</label>
                                  <textarea class="form-control" name="detail" id="detail">{{ $objProduct['detail'] }}</textarea>
                              </div>

                              <div class="form-group">
                                  <div class="col-md-4">
                                      <label>Phòng tắm</label>
                                      <input class="form-control" type="number" name="bedrooms" value="{{ $objProduct['bedrooms'] }}"  id="bedrooms" placeholder="Số lượng phòng tắm" min="0" max="999999999999">
                                  </div>

                                  <div class="col-md-4">
                                      <label>Phòng ngủ</label>
                                      <input class="form-control" type="number" value="{{ $objProduct['bathrooms'] }}" name="bathrooms" id="bathrooms" placeholder="Số lượng phòng ngủ" min="0" max="999999999999">
                                  </div>

                                  <div class="col-md-4">
                                      <label>Diện tích</label>
                                      <input class="form-control" type="text" name="sqrt" value="{{ $objProduct['sqrt'] }}" id="sqrt" placeholder="Diện tích" min="0" max="999999999999">
                                  </div>
                              </div>


                              <div class="form-group" style="margin-bottom: 5em;">
                                  <label>Thông số kỹ thuật (EN) </label>
                                  <table class="table configuration">
                                      @if ($objProduct['configuration'] <> null)
                                      @if(json_decode($objProduct['configuration'], true))
                                      <?php
                                        $configurations = json_decode($objProduct['configuration'], true);
                                        ?>
                                      @endif
                                      @forelse($configurations as $key=>$value)
                                          <tr>
                                              <td>    
                                                  <input class="form-control" name='configuration[]' type='text' value="{{ $value }}"/>
                                              </td>
                                          </tr>
                                      @empty
                                      @endforelse
                                      @endif
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
                                      <div class="row form-group text-center">
                                         <div class="d-inline " id="listimage">
                                            <input type="hidden" name="id_del_image" id="id_del_image" >
                                            @foreach($ImageProduct as $img)
                                            <div class="wp-image" id="{{$img->id}}">
                                               <img style='max-width: 120px !important; max-height: 120px !important;' class="img-thumbnail  listimage-edit" src="{{asset('image/files/detail_image/'.$img->image_detail)}}"/>
                                            </div>
                                            @endforeach
                                         </div>
                                      </div>
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
                                         <div id="thumbnail123" >
                                              <span>Hình cũ</span>
                                              <div style="height: 150px;" class="d-inline " id="listimage">
                                                  <input type="hidden" name="id_del_image123" id="id_del_image123" >
                                                  <div class="wp-image" id="{{ $objProduct['image']}}">
                                                      <img style='width: 100px;height: 100px;margin: 5px;' class="img-thumbnail123" src="{{asset('image/files/show_image/'.$objProduct['image'])}}"/>
                                                  </div>
                                             </div>
                                         </div>
                                      </div>
                                   </div>
                              </div>

                              <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Quận</label>
                                      <select class="form-control" name="district_id" id="district">
                                      <option value="">------ Xin chọn quận ------ </option>
                                          @foreach ($objDistrict as $value)
                                              <option value="{{$value->id}}" @if($value->id == $objProduct['district_id']) selected @endif>{{$value->name}} </option>
                                          @endforeach
                                      </select>
                                  </div>
                                  <div class="form-group">
                                    <label>Địa chỉ</label>
                                    <input class="form-control" type="text" name="address" placeholder="Xin nhập địa chỉ" value="{{ $objProduct['address'] }}">
                                  </div>

                                  <div class="form-group">
                                    <label>Giá tiền</label>
                                    <input class="form-control" type="number" step="0.1" name="price" placeholder="Xin nhập giá" value="{{ $objProduct['price'] }}">
                                  </div>
                                  <div class="form-group">
                                    <label>Tình trạng bài viết</label>
                                      <select class="form-control" name="active" id="active">
                                          <option value="">------ Xin chọn tình trạng bài viết ------ </option>
                                          @foreach ($objActive as $value)
                                              <option value="{{$value->id}}" @if($value->id == $objProduct['active_id']) selected @endif>{{$value->name}} </option>
                                          @endforeach
                                      </select>
                                  </div>

                                  <div class="form-group">
                                    <label>Tình trạng sản phẩm</label>
                                      <select class="form-control" name="status_id" id="status_id">
                                          <option value="">------ Xin chọn tình trạng sản phẩm ------ </option>
                                          @foreach ($objStatus as $value)
                                              <option value="{{$value->id}}" @if($value->id == $objProduct['status_id']) selected @endif>{{$value->name}} </option>
                                          @endforeach
                                      </select>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-12">
                          <div class="form-group">
                              <label>Mô tả</label>
                              <textarea class="form-control"  name="description">{{$objProduct['content'] }}</textarea>
                          </div>

                          <div class="row">
                            <div style="text-align: center;" class="col-md-12">
                                <button class="btn btn-primary nextBtn btn-lg" type="button" >Next</button>
                            </div>
                          </div>
                      </div>
                    </div>
                    <div class="row setup-content" id="step-2">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                  <label>Tiêu đề (VN )</label>
                                  <input class="form-control" type="text" name="name_vn" placeholder="Xin nhập tên sản phẩm" value="{{ $objProduct['name_vn'] }}">
                                </div>
                                <div class="form-group">
                                    <label>Chi tiết (VN)</label>
                                    <textarea class="form-control" name="detail_vn" id="detail_vn">{{ $objProduct['detail_vn']}}</textarea>
                                </div>

                                <div class="form-group">
                                  <label>Thông số (VN)</label>
                                  
                                  <table class="table configuration_vn">
                                      @if ($objProduct['configuration_vn'] <> null)
                                      @if(json_decode($objProduct['configuration_vn'], true))
                                      <?php
                                        $configurations_vn = json_decode($objProduct['configuration_vn'], true);
                                        ?>
                                      @endif
                                      @forelse($configurations_vn as $key=>$value)
                                          <tr id="colum_{{ $key }}">
                                              <td>    
                                                  <input class="form-control" name='configuration_vn[]' type='text' value="{{ $value }}"/>
                                              </td>
                                          </tr>
                                      @empty
                                      @endforelse
                                      @endif
                                  </table>
                                    <button id="btn_add_columns_vn" type="button" class="btn btn-sm btn-primary pull-left">
                                        <span class="glyphicon glyphicon-plus"></span>&nbsp;Thêm
                                    </button>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Mô tả (VN)</label>
                                    <textarea class="form-control" name="description_vn">{{ $objProduct['content_vn'] }}</textarea>
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