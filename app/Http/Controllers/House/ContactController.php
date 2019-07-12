<?php

namespace App\Http\Controllers\House;
use Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;
use Session;
use Carbon\Carbon;

class ContactController extends Controller
{
    public function index() {
    	

        if (session::get('locale') == "en") {
            $title          = "CONTACT | DA NANG RESIDENCE";
            $description    = "DaNang Residence will help you find the house for rent, apartment for rent, villa for rent in Da Nang as rapidly as possible. Phone: (84) 905 972 521.";
        } else {
            $title          = "LIÊN HỆ | DA NANG RESIDENCE";
            $description    = "DaNang Residence sẽ giúp bạn tìm nhà cho thuê, căn hộ cho thuê, biệt thự cho thuê tại Đà Nẵng càng nhanh càng tốt. Điện thoại: (84) 905 972 521";
        }
    	return view('house.contact.index',compact('title'))->with('description',$description)->with('image',asset('templates/house/img/bg-img/logo.jpg'));
    }

    public function post_Contact(ContactRequest $request) {
        try {
            DB::beginTransaction();
            $data                  = $request->all();
            $objContact            = new Contact;
            if($objContact->add_Items($request, null)){
                $data_mail             = [
                        'name'         =>    $data['username'],
                        'phone'        =>    $data['phone'],
                        'email'        =>    $data['email'],
                        'message_mail' =>    $data['message'],
                        'date'         =>    Carbon::now(),
                        'product_id'   =>    0,
                ];
                Mail::send('mail', $data_mail , function($message) use ($data){
                    $message->from('congthongtindue@gmail.com','Khách Hàng Liên Lạc');
                    $message->to('nghia97dn@gmail.com');
                    $message->subject("Email khách hàng: ".$data['email']);
                });
                DB::commit();
                $request->session()->flash('success','Bạn đã gửi tin thành công ! Chúng tôi sẽ trả lời trong thời gian sớm nhất');
                return redirect()->route('house.contact.index');
            } 
        } catch(\Exception $e) {
            DB::rollback();
            $request->session()->flash('fail','Gửi tin thất bại ! Vui lòng thử lại hoặc liên hệ qua Fanpage');
            return redirect()->route('house.contact.index');
        }
    }

    public function index_admin(){
        $objContact = Contact::get();
        return view('admin.contact.index',compact('objContact'));
    }

    public function reply_contact(Request $request ){
        try {
            DB::beginTransaction();
            $objContact         = Contact::findOrfail($request->input('id'));
            $objContact->reply  = $request->input('reply_id');
            $objContact->save();
            DB::commit();
            return response()->json(['success'=> 'Cập nhật thành công!']);
        } catch(\Exception $e) {
            DB::rollBack();
            return response()->json(['error'=> 'Cập nhật thất bại!']);
        }
    }


    public function ajax_Contact(Request $request) {
        $query = Contact::query();
        if ($request->has('search') && !empty($request->search)) {
            $query = $query->where('id', 'like','%'. $request->search.'%')
                ->orWhere('name', 'like','%'. $request->search.'%')
                ->orWhere('phone', 'like','%'. $request->search.'%')
                ->orWhere('email', 'like','%'. $request->search.'%')
                ->orWhere('product_id', 'like','%'. $request->search.'%')
                ->orWhere('message', 'like','%'. $request->search.'%');
        }

        if(!empty($request->date_start) && !empty($request->date_end)){
            $date_start = $request->date_start;
            $date_end = $request->date_end;
            $query = $query->whereBetween('created_at', [$date_start, $date_end]);
        }


        if ($request->has('status') && !empty($request->status)) {
            switch ($request->status){
                case 1:
                    $query = $query->where('reply',1);
                    break;
                case 2:
                    $query = $query->where('reply',2);
                    break;
            }
        }

        if($request->ajax()){
            $objContact = $query->orderByDesc('created_at')
                ->paginate(10)
                ->appends(request()->query());
            $view = view('admin.ajax.ajax_contact',compact(['objContact']))->render();
            return response()->json(['view' => $view],200);
        }

        $objContact = $query->orderByDesc('created_at')->paginate(10)->appends(request()->query());
        return view('admin.contact.index',compact('objContact'));
    }
}
