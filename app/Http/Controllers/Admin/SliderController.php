<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Active;
use Illuminate\Support\Facades\DB;
use File;
use Helpers;

class SliderController extends Controller
{
    public function index_Index() {
    	$objSlider	= Slider::where('location',1)->get();
    	return view('admin.slider.index.index',compact('objSlider'));
    }

    public function get_Index_Add(){
    	$objActive	= Active::get();
    	$objSlider	= Slider::where('location',1)->get();

        $objProduct = DB::table("product")->select('*')->whereNotIn('id',function($query) {
            $query->select('product_id')->from('slider')->where('location',1);
        })->get();
		return view('admin.slider.index.add',compact('objProduct','objActive'));
    }

    public function post_Index_Add(Request $request){
    	try{
    		DB::beginTransaction();
			$data = $request->all();
	        $file = $request->file('image_detail123');
	        if(!is_null($file)){
	            $fileName = $this->image_detail123 = time() . "_" . rand(5, 5000000).'_'. $request->image_detail123->getClientOriginalName();
	            $request->fileName 		= $fileName;
	        } else {
	            $request->fileName 		= 'null.jpg';
	        }
	        $objProduct 				= new Slider;
	        $objProduct->product_id		= $data['product'];
	        $objProduct->location		= 1;
	        $objProduct->position		= $data['position'];
	        $objProduct->active_id		= $data['active'];
	        $objProduct->image			= $request->fileName;

	        if($objProduct->save()){
	    	 	if(!is_null($file)){
                    $file->move('image/files/slider_index/',$fileName);
	    	 	}
	    	 	DB::commit();
	            $request->session()->flash('msg','Thêm thành công');
	            return redirect()->route('admin.slider.index.index');
	        }
    	} catch(\Exception $e){
    		DB::rollback();
    		$request->session()->flash('msg','Thêm thất bại');
            return redirect()->route('admin.slider.index.add');
    	}
    	
    }


    public function get_Index_Edit(Request $request, $id) {
        $objSlider  = Slider::findOrfail($id);
        $objActive  = Active::get();
        return view('admin.slider.index.edit',compact('objSlider','objActive'));
    }


    public function post_Index_Edit(Request $request, $id) {
        $data = $request->all();
        try{
            DB::beginTransaction();
            $slider    = Slider::findOrFail($id);
            // Ảnh đại điện
            $images123 = $request->file('image_detail123');
            if($images123) {
                $name123 = $request->fileName  = 'avatar_'.time() . "_" .rand(5, 5000000).'_'. $images123->getClientOriginalName();
            } else {
                $request->fileName = $slider['image'];
            }
        
            $objSlider                     = new Slider();
            $objItem                       = $objSlider->findOrfail($id);
            $objItem->position             = $data['position'];
            $objItem->active_id            = $data['active'];
            $objItem->image                = $request->fileName;
            
            if($objItem->save()){
                if($images123){
                    $oldimage123 = $_SERVER["DOCUMENT_ROOT"]. '/public/image/files/slider_index/'.$slider['image'];
                    if(file_exists($oldimage123)) {
                        unlink($oldimage123);
                    }
                    $images123->move('image/files/slider_index/',$name123);
                }
                DB::commit();
                $request->session()->flash('msg','Sửa thành công');
                return redirect()->route('admin.slider.index.index');
            }
        } catch(\Exception $e) {
            DB::rollback();
            $request->session()->flash('msg','Sửa thất bại');
            return redirect()->route('admin.slider.index.edit',$id);
        }
    }

    public function delete_slider_index(Request $request) {
        try {
            $Image        = Slider::where('id', $request->input('id'))->first();
            $patch_name   = 'storage/app/public/files/slider_index/'.$Image['image'];
            File::delete($patch_name);
            $deletedRows = Slider::where('id', $request->id)->delete();
            return response()->json(['success'=> 'Xóa thành công!']);
        } catch(\Exception $e) {
            DB::rollBack();
            return response()->json(['error'=> 'Xóa thất bại!']);
        }
    }

    public function index_Product(){
        $objSlider  = Slider::where('location',2)->get();
        return view('admin.slider.product.index',compact('objSlider'));
    }

    public function get_Product_Add() {
        $objActive  = Active::get();
        $objSlider  = Slider::where('location',2)->get();
        $objProduct = DB::table("product")->select('*')->whereNotIn('id',function($query) {
            $query->select('product_id')->from('slider')->where('location',2);
        })->get();
        return view('admin.slider.product.add',compact('objProduct','objActive'));
    }

    public function post_Product_Add(Request $request){
        try{
            DB::beginTransaction();
            $data = $request->all();
            $file = $request->file('image_detail123');
            if(!is_null($file)){
                $fileName = $this->image_detail123 = time() . "_" . rand(5, 5000000).'_'. $request->image_detail123->getClientOriginalName();
                $request->fileName      = $fileName;
            } else {
                $request->fileName      = 'null.jpg';
            }
            $objProduct                 = new Slider;
            $objProduct->product_id     = $data['product'];
            $objProduct->location       = 2;
            $objProduct->position       = $data['position'];
            $objProduct->active_id      = $data['active'];
            $objProduct->image          = $request->fileName;

            if($objProduct->save()){
                if(!is_null($file)){
                    $file->move('image/files/slider_product/',$fileName);
                }
                DB::commit();
                $request->session()->flash('msg','Thêm thành công');
                return redirect()->route('admin.slider.product.index');
            }
        } catch(\Exception $e){
            DB::rollback();
            $request->session()->flash('msg','Thêm thất bại');
            return redirect()->route('admin.slider.product.add');
        }
    }

    public function get_Product_Edit(Request $request, $id) {
        $objSlider  = Slider::findOrfail($id);
        $objActive  = Active::get();
        return view('admin.slider.product.edit',compact('objSlider','objActive'));
    }


    public function post_Product_Edit(Request $request, $id) {
        $data = $request->all();
        try{
            DB::beginTransaction();
            $slider    = Slider::findOrFail($id);
            // Ảnh đại điện
            $images123 = $request->file('image_detail123');
            if($images123) {
                $name123 = $request->fileName  = 'avatar_'.time() . "_" .rand(5, 5000000).'_'. $images123->getClientOriginalName();
            } else {
                $request->fileName = $slider['image'];
            }
        
            $objSlider                     = new Slider();
            $objItem                       = $objSlider->findOrfail($id);
            $objItem->position             = $data['position'];
            $objItem->active_id            = $data['active'];
            $objItem->image                = $request->fileName;
            
            if($objItem->save()){
                if($images123){
                    $oldimage123 = $_SERVER["DOCUMENT_ROOT"]. '/storage/app/public/files/slider_product/'.$slider['image'];
                    if(file_exists($oldimage123)) {
                        unlink($oldimage123);
                    }
                    $images123->move('image/files/slider_product/',$name123);
                }
                DB::commit();
                $request->session()->flash('msg','Sửa thành công');
                return redirect()->route('admin.slider.product.index');
            }
        } catch(\Exception $e) {
            DB::rollback();
            $request->session()->flash('msg','Sửa thất bại');
            return redirect()->route('admin.slider.product.edit',$id);
        }
    }

    public function delete_slider_product(Request $request) {
        try {
            $Image        = Slider::where('id', $request->input('id'))->first();
            $patch_name   = 'storage/app/public/files/slider_product/'.$Image['image'];
            File::delete($patch_name);
            $deletedRows = Slider::where('id', $request->id)->delete();
            return response()->json(['success'=> 'Xóa thành công!']);
        } catch(\Exception $e) {
            DB::rollBack();
            return response()->json(['error'=> 'Xóa thất bại!']);
        }
    }
}
