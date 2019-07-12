<?php

namespace App\Http\Controllers\House;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\Product;
use App\Models\Choose;
use Session;

class CatController extends Controller
{
    public function Ajax_Product(Request $request) {
        if(!empty($request->collection)) {
            $query = Product::select('product.*','collection.*','collection.name as title','collection.id as id_title','product.id as id','product.name as name','product.name_vn as name_vn')->join('collection','collection.id','=','product.collection_id')->where('active_id',2)->where('choose_id',$request->choose)->where('collection_id',$request->collection);
        } else {
            $query = Product::select('product.*','collection.*','collection.name as title','collection.id as id_title','product.id as id','product.name as name','product.name_vn as name_vn')->join('collection','collection.id','=','product.collection_id')->where('active_id',2)->where('choose_id',$request->choose);
        }
       
        if ($request->has('status') && !empty($request->status)) {
            switch ($request->status){
                case 1://Mới nhất
                    $query = $query->orderByDesc('id_title');
                    break;
                case 2:// Giá Từ Cao Đến 
                    $query = $query->orderBy('price', 'desc');
                    break;
                case 3:// Giá Từ Thấp Đến Cao
                    $query = $query->orderBy('price', 'asc');
                    break;
            }
        }
       
        if($request->ajax()){
            $objProducts = $query
                ->paginate(10)
                ->appends(request()->query());
            $view = view('house.cat.ajax_product',compact(['objProducts']))->render();

            return response()->json(['view'=>$view],200);
        }
        

    }

    public function Choose_Collection($name1, $name) {
        $objChoose      = Choose::where('name',$name1)->first();
        $id_choose      = $objChoose['id'];
        $objCollection  = Collection::where('name_ascii',$name)->first();
        $id_collection  = $objCollection['id'];
        

        if (session::get('locale') == "en") {
            $title = strtoupper($name1)." - ". strtoupper($objCollection['name']) ." | DA NANG RESIDENCE" ;
        } else {
            $title = strtoupper($objChoose['name_vn'])." - ". strtoupper($objCollection['name_vn']) ." | DA NANG RESIDENCE" ;
        }


        $objProducts     = Product::select('product.*','collection.*','product.name as title','product.id as id_title')->join('collection','collection.id','=','product.collection_id')->where('active_id',2)->where('choose_id', $objChoose['id'])->where('collection_id', $objCollection['id'])->orderbyDESC('id_title')->paginate(10);
        return view('house.cat.choose_collection',compact('title','objProducts','id_choose','id_collection'))->with('key_word', '')->with('key_word', '')->with('district','')->with('collection','')->with('choose','')->with('bedrooms','')->with('bathrooms','')->with('description',$title)->with('image',asset('templates/house/img/bg-img/logo.jpg'));
    }

    public function Choose_Product($name) {
        $objChoose      = Choose::where('name',$name)->first();
        $id_choose      = $objChoose['id'];
       
        if (session::get('locale') == "en") {
             $title     = strtoupper($name)." | DA NANG RESIDENCE" ;
        } else {
            $title      = strtoupper($objChoose['name_vn'])." | DA NANG RESIDENCE" ;
        }


        $objProducts     = Product::select('product.*','collection.*','collection.name as title','collection.id as id_title','product.id as id','product.name as name','product.name_vn as name_vn')->join('collection','collection.id','=','product.collection_id')->where('active_id',2)->where('choose_id', $objChoose['id'])->orderByDesc('product.id')->paginate(10);
         return view('house.cat.choose_product',compact('title','objProducts','id_choose'))->with('key_word', '')->with('key_word', '')->with('district','')->with('collection','')->with('choose','')->with('bedrooms','')->with('bathrooms','')->with('description',$title)->with('image',asset('templates/house/img/bg-img/logo.jpg'));
    }
}
