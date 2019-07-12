<table id="example2" class="table table-bordered table-hover">
    <thead>
    <tr>
      <th class="text-center">ID</th>
      <th class="text-center">MÃ SẢN PHẨM</th>
      <th class="text-center">TÊN BÀI VIẾT (EN)</th>
      <th class="text-center">HÌNH ẢNH</th>
      <th class="text-center">DANH MỤC</th>
      <th class="text-center">TRẠNG THÁI</th>
      <th class="text-center">
          <a href="{{ route('admin.product.add') }}" class="btn btn-sm btn-success">
              <span class="glyphicon glyphicon-plus"></span>&nbsp;Thêm
          </a>
      </th>
    </tr>
    </thead>
    <tbody>
      @foreach ($objProduct as $value)
        <tr id="delete-coloum-{{$value->id}}" data-id="{{ $value->id }}">
          <td class="text-center">{{ $value->id }}</td>
          <td class="text-center">{{ $value->code }}</td>
          <td><a href="{{ route('house.product.index',['id'=>$value->id,'name' => str_slug($value->name)]) }}">{{ $value->name}}</a></td>
          <td class="text-center"><img width="100px" height="100px" class="img img-thumbnail" src="{{ asset('image/files/show_image/'.$value->image)}}"></td>
          <td class="text-center">{{$value->collection->name}}</td>
          <td  id="trangthai_{{$value->id}}" class="text-center">
              <div class="row">
                  @if ($value->active_id == 0)
                    <a href="javascript:void()">
                      <img src="http://event.titans.mu/event/image/deactive.gif">
                    </a>
                  @else
                    <a href="javascript:void()">
                      <img src="http://event.titans.mu/event/image/active.gif">
                    </a>
                  @endif
              </div>
          </td>
          <td class="text-center">
            <a href="{{ route('admin.product.edit',[$value->id]) }}" class="btn btn-info btn-xs">
                <i class="fa fa-eye fa-fw"></i><span>Sửa</span>
            </a>
            <button class="btn btn-danger btn-xs" id="delete-product" value="{{$value->id}}">Xóa</button>

          </td>
        </tr>
      @endforeach
    </tbody>
    <tfoot>
    <tr>
      <th class="text-center">ID</th>
      <th class="text-center">MÃ SẢN PHẨM</th>
      <th class="text-center">TÊN BÀI VIẾT (EN)</th>
      <th class="text-center">HÌNH ẢNH</th>
      <th class="text-center">DANH MỤC</th>
      <th class="text-center">TRẠNG THÁI</th>
      <th></th>
    </tr>
    </tfoot>
</table>