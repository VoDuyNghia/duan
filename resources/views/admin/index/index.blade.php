@extends("templates.admin.master")
@section("content")
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        THÔNG TIN
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.index.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">THÔNG TIN</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
          @foreach($boxes as $box)
              <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box {{ $box['background'] }}">
                      <div class="inner">
                          <h3>{{ $box['count'] }}</h3>

                          <p>{{ $box['title'] }}</p>
                      </div>
                      <div class="icon">
                          <i class="{{ $box['icon'] }}"></i>
                      </div>
                      <a href="{{ $box['url'] }}" class="small-box-footer">Chi tiết 
                      <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
              </div>
              <!-- ./col -->
          @endforeach
      </div>
    </section>
  </div>
@endsection