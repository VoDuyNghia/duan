<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\User;
use App\Models\Contact;
use App\Models\Product;
use DB;


class DashboardController extends Controller
{
    public function index() {
    	$title = "Admin | Dashboard";
        $newContact = Contact::where('reply',1)->where('created_at','>', Carbon::yesterday())->count();
        $Contact    = Contact::where('reply',1)->count();
        $Product 	= Product::whereMonth('created_at',Carbon::now()->format('m'))->count();
        $boxes = [
            'newContact' => [
                'count' => $newContact,
                'title' => 'Liên Lạc Gần Đây ( Chưa Rely)',
                'icon'  => 'ion ion-bag',
                'background'  => 'bg-green',
                'url'   => route('ajax_contact',[
                    'date_start' => Carbon::yesterday()->format('Y-m-d H:m:i'),
                    'date_end' => Carbon::now()->format('Y-m-d H:m:i'),
                    'status' => 1
                ]),
            ],

            'Contact' => [
                'count' => $Contact,
                'title' => 'Liên Lạc Chưa Reply',
                'icon'  => 'ion ion-bag',
                'background'  => 'bg-aqua',
                'url'   => route('ajax_contact',['status' => 1]),
            ],

            'Product' => [
                'count' => $Product,
                'title' => 'Tổng SP Trong  Tháng',
                'icon'  => 'ion ion-bag',
                'background'  => 'bg-yellow',
                'url'   => route('ajax_product',[
                    'date_start' => Carbon::now()->startofMonth()->toDateString(),
                    'date_end'   => Carbon::now()->endOfMonth()->toDateString(),
                ]),
            ],


        ];
    	return view("admin.index.index",compact('boxes'));
    }
}
