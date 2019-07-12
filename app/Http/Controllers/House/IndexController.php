<?php

namespace App\Http\Controllers\House;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use App\Models\Product;
use App\Models\News;
use Illuminate\Support\Facades\Input;
use Session;

class IndexController extends Controller
{
    public function index() {
        if (session::get('locale') == "en") { $title = "HOME | DA NANG RESIDENCE"; $description = "DaNang Residence will help you find the house for rent, apartment for rent, villa for rent in Da Nang as rapidly as possible. All about for rent in Da Nang."; } else { $title = "TRANG CHỦ | DA NANG RESIDENCE"; $description = "DaNang Residence sẽ giúp bạn tìm nhà cho thuê, căn hộ cho thuê, biệt thự cho thuê tại Đà Nẵng càng nhanh càng tốt. Tất cả về cho thuê tại Đà Nẵng";};
        $objProducts = Product::where('active_id',2)->orderbyDESC('id')->take(9)->get();

        return view("house.index.index",compact('title','objProducts','title'))->with('key_word', '')->with('key_word', '')->with('district','')->with('collection','')->with('choose','')->with('bedrooms','')->with('bathrooms','')->with('description',$description)->with('image',asset('templates/house/img/bg-img/logo.jpg'));
    }

    public function search(Request $request) {
        $key_word   =  $request->search;

        if (session::get('locale') == "en") {
            $title = $key_word.' - SEARCH '.$key_word. " | DA NANG RESIDENCE";
        } else {
            $title =  $key_word.' - Tìm Kiếm '.$key_word. " | DA NANG RESIDENCE";
        }


        $objNews    =  News::where('active_id',2)->where('name', 'like','%'. $key_word.'%')->orwhere('detail', 'like','%'. $key_word.'%')->orwhere('content', 'like','%'. $key_word.'%')->orderbyDESC('id')->paginate(10);

        $objProducts = Product::where('active_id',2)->where('name', 'like','%'. $key_word.'%')->orwhere('detail', 'like','%'. $key_word.'%')->orwhere('code', 'like','%'. $key_word.'%')->orwhere('content', 'like','%'. $key_word.'%')->orwhere('price', 'like','%'. $key_word.'%')->orwhere('address', 'like','%'. $key_word.'%')->orderbyDESC('id')->paginate(10);
        return view('house.index.search',compact('title','objNews','objProducts','key_word'))->with('description',$title)->with('image',asset('templates/house/img/bg-img/logo.jpg'));
    }

    public function search_product(Request $request) {
       
        if (session::get('locale') == "en") {
            $title = "ADVANCED SEARCH | DA NANG RESIDENCE";
        } else {
            $title = "TÌM KIẾM NÂNG CAO | DA NANG RESIDENCE";
        }

        $query      = Product::query();       
        $filters = [
            'key_word'   => Input::get('input'),
            'district'   => Input::get('cities') ,
            'collection' => Input::get('collection'),
            'choose'     => Input::get('status'),
            'bedrooms'   => Input::get('bedrooms'),
            'bathrooms'  => Input::get('bathrooms'),
            'min_price'  => Input::get('min_price'),
            'max_price'  => Input::get('max_price'),
            'min_sqrt'  => Input::get('min_sqrt'),
            'max_sqrt'  => Input::get('max_sqrt'),
        ];

        $key_word       = $filters["key_word"];
        $district       = $filters["district"];
        $collection     = $filters["collection"];
        $choose         = $filters["choose"];
        $bedrooms       = $filters["bedrooms"];
        $bathrooms      = $filters["bathrooms"];


        $objProducts   = Product::where(function ($query) use ($filters) {
            if (!empty($request->input)) {
                $query->where('eye_color', '=', $filters['eye_color']);

                $query = $query->where('id', 'like','%'.  $filters['key_word'].'%')
                ->orWhere('name', ' like','%'.  $filters['key_word'].'%')
                ->orWhere('code', ' like','%'.  $filters['key_word'].'%')
                ->orWhere('detail', 'like','%'.  $filters['key_word'].'%')
                ->orWhere('content', 'like','%'.  $filters['key_word'].'%');
            }

            if (!empty($filters['district'])) {
                $query->where('district_id', '=', $filters['district']);
            }

            if (!empty($filters['collection'])) {
                $query->where('collection_id', '=', $filters['collection']);
            }

            if (!empty($filters['choose'])) {
                $query->where('choose_id', '=', $filters['choose']);
            }

            if (!empty($filters['bedrooms'])) {
                 $query->where('bedrooms', '=', $filters['bedrooms']);
            }

            if (!empty($filters['bathrooms'])) {
                 $query->where('bathrooms', '=', $filters['bathrooms']);
            }

            if (!empty($filters['min_price']) && !empty($filters['max_price'])) {
                $query->whereBetween('price',[$filters['min_price'],$filters['max_price']]);
            }

            if (!empty($filters['min_sqrt']) && !empty($filters['max_sqrt'])) {
                $query->whereBetween('sqrt',[$filters['min_sqrt'],$filters['max_sqrt']]);
            }
        })->paginate(9);
        
        return view('house.index.search_product',compact('objProducts','title','key_word','district','collection','choose','bedrooms','bathrooms'))->with('description',$title)->with('image',asset('templates/house/img/bg-img/logo.jpg'));
    }
}
