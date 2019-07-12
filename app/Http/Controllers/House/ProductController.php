<?php

namespace App\Http\Controllers\House;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use App\Models\Product;
use App\Models\ImageDetail;
use App\Model\Collection;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Session;
use Mail;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function index($name, $id) {
    	$objProducts = Product::where('active_id',2)->where('id',$id)->first();
    	$objImage	 = ImageDetail::where('product_id',$id)->get();
    	
        if (session::get('locale') == "en") {
            $title       = $objProducts['name'].' - '.$objProducts->collection->name .' | DA NANG RESIDENCE';
            $description = $objProducts['detail'].' | DA NANG RESIDENCE';
        } else {
            $title       = $objProducts['name_vn'].' - '.$objProducts->collection->name_vn.' | DA NANG RESIDENCE';
            $description = $objProducts['detail_vn'].' | DA NANG RESIDENCE';
        }

        return view("house.product.index",compact('title','objImage','title','objProducts'))->with('key_word', '')->with('key_word', '')->with('district','')->with('collection','')->with('choose','')->with('bedrooms','')->with('bathrooms','')->with('description',$description)->with('image',asset('image/files/show_image/'.$objProducts['image']));
    }

    public function post_ContactPR($name, $id, ContactRequest $request) {
        $product = Product::findOrfail($id);
    	$data 						=  $request->all();
    	$objContact 				=  new Contact;
    	if($objContact->add_Items($request, $id)){
            $data_mail             = [
                    'name'         =>    $data['username'],
                    'phone'        =>    $data['phone'],
                    'email'        =>    $data['email'],
                    'message_mail' =>    $data['message'],
                    'date'         =>    Carbon::now(),
                    'product_id'   =>    $product['id'],
                    'name_product' =>    $product['name'],
            ];
            Mail::send('mail', $data_mail , function($message) use ($data){
                $message->from('congthongtindue@gmail.com','Khách Hàng Liên Lạc');
                $message->to('nghia97dn@gmail.com');
                $message->subject("Email khách hàng: ".$data['email']);
            });
    		$request->session()->flash('success','Bạn đã gửi tin thành công ! Chúng tôi sẽ trả lời trong thời gian sớm nhất');
        	return redirect()->route('house.product.index', ['name'=>$name, 'id'=>$id]);
    	} else {
    		$request->session()->flash('fail','Gửi tin thất bại ! Vui lòng thử lại hoặc liên hệ qua Fanpage');
        	return redirect()->route('house.product.index', ['name'=>$name, 'id'=>$id]);
    	}
    }
}
