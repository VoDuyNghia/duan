@extends("templates.admin.master")
@section("content")
<div class="content-wrapper" style="min-height: 445px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Thêm Pages
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.index.index') }}"><i class="fa fa-dashboard"></i>Admin</a></li>
            <li class="active">Thêm Pages</li>
        </ol>
    </section>
    <div class="container" style="padding-top: 30px">
	<section class="content container-fluid">
	    <div class="box">
	        <div class="box-header">
	            <h3 class="box-title">Thêm Pages</h3>
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
				<form action="{{ route('admin.pages.add') }}" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">  
					{{ csrf_field() }}  
                    <div class="row setup-content" id="step-1">            
    					<div class="row">
    						<div class="col-md-12">
    							<div class="form-group">
    							  <label>Tiêu đề (EN)</label>
    							  <input class="form-control" type="text" name="name" placeholder="Xin nhập tên tiêu đề" value="{{ old('name') }}">
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
                            <div class="col-md-12">
                                <div class="form-group">
                                  <label>Tiêu đề (VN)</label>
                                  <input class="form-control" type="text" name="name_vn" placeholder="Xin nhập tên tiêu đề" value="{{ old('name_vn') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Mô tả (VN)</label>
                                    <textarea class="form-control"  name="description_vn">{{ old('description_vn') }}</textarea>
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