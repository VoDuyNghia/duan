              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th class="text-center">ID</th>
                  <th class="text-center">USERNAME</th>
                  <th class="text-center">PHONE</th>
                  <th class="text-center">EMAIL</th>
                  <th class="text-center">PRODUCT(IF ANY)</th>
                  <th class="text-center">CONTENT</th>
                  <th class="text-center">DATE</th>
                  <th class="text-center">ANSWERED</th>
                  <th class="text-center"></th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($objContact as $value)
                    <tr id="delete-coloum-{{$value->id}}" data-id="{{ $value->id }}">
                  		<td class="text-center">{{ $value->id }}</td>
                  		<td class="text-center">{{ $value->name }}</td>
                  		<td class="text-center">{{ $value->phone}}</td>
                  		<td class="text-center">{{$value->email}}</td>
                  		<td class="text-center">
                      	@if ($value->product_id <> null)
		                  	@php
		                  		$arr = [
		                  			'name' => str_slug($value->product->name),
		                  			'id'   => $value->product_id,
		                  		]
		                  	@endphp
                      		<a href="{{ route('house.product.index',$arr) }}">{{$value->product->name}}</a>
                      	@endif
                      	</td>
                  		<td style="word-break: break-word;" class="text-center">
					      <button style='font-weight:bold; text-transform: uppercase; background: none repeat scroll 0 0 #2f64da;border: medium none;color: #fff;padding: 6px 25px;' id="show_{{ $value->id}}" class="show_content" value="{{ $value->id}}">HIỆN NỘI DUNG</button>
						    <button style='display: none;font-weight:bold; text-transform: uppercase; background: none repeat scroll 0 0 #2f64da;border: medium none;color: #fff;padding: 6px 25px;' id="hide_{{ $value->id}}" class="hide_content" value="{{ $value->id}}">ẨN NỘI DUNG</button>
							<br/>
							<p style='display: none;' id="content_{{ $value->id}}"> {{$value->message}} </p>
                  		</td>
                  		<td class="text-center">
                      		{{ Carbon\Carbon::createFromTimestamp(strtotime($value->created_at))->diffForHumans() }}
                      	</td>
                      	<td>
                      		  <select id="reply_{{ $value->id }}" data-id="{{ $value->id }}"class="target">
							    <option <?php if ($value->reply == 1 ) echo 'selected' ; ?> value="1">No Answered</option>
							    <option <?php if ($value->reply == 2 ) echo 'selected' ; ?> value="2">Answered</option>
							  </select>
                      	</td>
                  		<td class="text-center">
                        	<button class="btn btn-danger btn-xs" id="delete-product" value="{{$value->id}}">Xóa</button>
                      	</td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                <tr>
          					<th class="text-center">ID</th>
          					<th class="text-center">USERNAME</th>
          					<th class="text-center">PHONE</th>
          					<th class="text-center">EMAIL</th>
          					<th class="text-center">PRODUCT(IF ANY)</th>
          					<th class="text-center">CONTENT</th>
          					<th class="text-center">DATE</th>
          					<th class="text-center">ANSWERED</th>
                </tr>
                </tfoot>
            </table>