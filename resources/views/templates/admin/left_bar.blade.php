<aside class="main-sidebar">
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ asset('/public/templates/admin') }}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{ Auth::user()->name }}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li><a href="{{ Route('admin.cat.index') }}"><i class="fa fa-book"></i> <span>Quản Lý Danh Mục</span></a></li>
      <li><a href="{{ Route('admin.users.index') }}"><i class="fa fa-user"></i> <span>Quản Lý Thành viên</span></a></li>
      <li><a href="{{ Route('admin.product.index') }}"><i class="fa fa-product-hunt"></i> <span>Quản Lý Sản phẩm</span></a></li>
      <li><a href="{{ Route('admin.news.index') }}"><i class="fa fa-th"></i> <span>Quản Lý Blogs</span></a></li>
      <li><a href="{{ Route('admin.pages.index') }}"><i class="fa fa-files-o"></i> <span>Quản Lý Pages</span></a></li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-laptop"></i>
          <span>Quản lý Slider</span>
          <span class="pull-right-container">
            <span class="label label-primary pull-right">2</span>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{ Route('admin.slider.index.index') }}"><i class="fa fa-circle-o"></i> Slider trang chủ</a></li>
          <li><a href="{{ Route('admin.slider.product.index') }}"><i class="fa fa-circle-o"></i> Slider sản phẩm</a></li>
        </ul>
      </li>
      <li><a href="{{ Route('admin.contact.index') }}"><i class="fa fa-envelope"></i> <span>Quản Lý Liên Lạc</span></a></li>
    </ul>
  </section>
</aside>