<body>
    <span style="color:black;font-weight: bold"> Người gửi: </span>  {{ $name }} <br/> <br/>
    <span style="color:black;font-weight: bold"> Email người gửi: </span>  {{ $email }} <br/> <br/>
    <span style="color:black;font-weight: bold"> Hotline người gửi: </span>  {{ $phone }} <br/> <br/>
    <span style="color:black;font-weight: bold"> Thời gian gửi: </span>  {{ $date }} <br/> <br/>
    @if ($product_id <> 0)
        <span style="color:black;font-weight: bold"> Thông tin sản phẩm: </span>  <a href="{{ route('house.product.index',['name' => str_slug($name),'id'=> $product_id]) }}">{{ $name_product }}</a> <br/> <br/>
    @endif
    <span>
        <p style="color:black;font-weight: bold">Nội dung: </p>
        {!! $message_mail !!}
    </span>
</body>
