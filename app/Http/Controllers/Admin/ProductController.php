<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Collection;
use App\Models\Product;
use App\Models\Choose;
use App\Models\District;
use App\Models\ImageDetail;
use Intervention\Image\Facades\Image;
use App\Models\Active;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductRequest;
use Validator,Redirect,Response,File;
use Helpers;

class ProductController extends Controller
{   

   public function __construct(Status $objStatus, Collection $objCollection, Choose $objChoose, District $objDistrict, Product $objProduct, Active $objActive){
        $this->objCollection = $objCollection;
        $this->objChoose     = $objChoose;
        $this->objDistrict   = $objDistrict;
        $this->objProduct    = $objProduct;
        $this->objActive     = $objActive;
        $this->objStatus     = $objStatus;
    }

    public function index() {
        $objProduct = Product::get();
    	return view('admin.product.index',compact('objProduct'));
    }

    public function get_Add() {
        $objChoose          = $this->objChoose->get_Choose();
        $objCollection      = $this->objCollection->get_Collection();
        $objDistrict        = $this->objDistrict->get_District();
        $objActive          = $this->objActive ->get_Active();
        $objStatus          = $this->objStatus ->get_Status();
        return view('admin.product.add',compact('objCollection','objChoose','objDistrict','objActive','objStatus'));
    }

    public function post_Add(ProductRequest $request) {

        $file = $request->file('image_detail123');
        if(!is_null($file)){
            $fileName = $this->image_detail123 = time() . "_" . rand(5, 5000000).'_'. $request->image_detail123->getClientOriginalName();
            $request->fileName = $fileName;
        } else {
            $request->fileName = 'null.jpg';
        }
        try {
            if($this->objProduct->add_Items($request)) {
                
            if(!is_null($file)){
                $file->move('image/files/show_image/',$fileName);
            }
                
            $images = $request->file('image_detail');
            if($images){
                $id =DB::getPdo()->lastInsertId();
                foreach ($images as $image){
                    $name = time() . "_" . rand(5, 5000000).'_'. $image->getClientOriginalName();  
                    $url = "image/files/detail_image";
                    Helpers::watermark_detail($image,$name,$url);
                    ImageDetail::create([
                        'image_detail'  => $name,
                        'product_id'    => $id,
                    ]);
                   
                }
            }
                DB::commit();
                $request->session()->flash('msg','Thêm thành công');
                return redirect()->route('admin.product.index');
            }
        } catch(\Exception $e) {
            DB::rollback();
            $request->session()->flash('msg','Thêm thất bại');
            return redirect()->route('admin.product.add');
        }
    }
    public function post_Delete(Request $request ){
        try {

            $Image        = Product::where('id', $request->input('id'))->first();
            $patch_name   = 'image/files/show_image/'.$Image['image'];
            File::delete($patch_name);

            $Image_name_  = ImageDetail::where('product_id', $request->input('id'))->get();
            foreach ($Image_name_ as $value) {
                $patch = 'image/files/detail_image/'.$value->image_detail;
                File::delete($patch);
            } 
            $Product        = Product::where('id', $request->input('id'))->delete();
            $Image_Product  = ImageDetail::where('product_id', $request->input('id'))->delete();
            return response()->json(['success'=> 'Xóa thành công!']);
        } catch(\Exception $e) {
            DB::rollBack();
            return response()->json(['error'=> 'Xóa thất bại!']);
        }
    }

    public function get_Edit(Request $request,$id) {
        $objChoose          = $this->objChoose->get_Choose();
        $objCollection      = $this->objCollection->get_Collection();
        $objDistrict        = $this->objDistrict->get_District();
        $objActive          = $this->objActive ->get_Active();
        $objStatus          = $this->objStatus ->get_Status();
        $objProduct         = Product::findOrfail($id);
        $ImageProduct       = ImageDetail::where('product_id',$id)->get();
        return view("admin.product.edit",compact('objCollection','objChoose','objDistrict','objActive','objStatus','objProduct','ImageProduct'));
    }

    public function post_Edit($id, ProductRequest $request) {
        try{
            DB::beginTransaction();
            $product    = Product::findOrFail($id);
            
            // Ảnh đại điện  
            $images123 = $request->file('image_detail123');
            if($images123) {
                $name123 = $request->fileName  = 'avatar_'.time() . "_" .rand(5, 5000000).'_'. $images123->getClientOriginalName();
            } else {
                $request->fileName = $product['image'];
            }

            
            if($this->objProduct->post_Edit($request,$id)) {
                // Xóa ảnh đại diện
                if($images123){
                    $images123->move('image/files/show_image/',$name123);
                    $oldimage123 = $_SERVER["DOCUMENT_ROOT"]. '/public/image/files/show_image/'.$product['image'];
                    if(file_exists($oldimage123)) {
                        unlink($oldimage123);
                    }
                }
                /// Thêm ảnh mô tả
                $images = $request->file('image_detail');
                if($images){
                    foreach ($images as $image){
                        $name = time() . "_" . rand(5, 5000000).'_'. $image->getClientOriginalName();
                        $url = "image/files/detail_image";
                        Helpers::watermark_detail($image,$name,$url);
                        ImageDetail::create([
                            'image_detail'  => $name,
                            'product_id'    => $id,
                        ]);
                    }
                }
                DB::commit();
                $request->session()->flash('msg','Sửa thành công');
                return redirect()->route('admin.product.index');
            }
        } catch(\Exception $e){
            DB::rollback();
            $request->session()->flash('msg','Sửa thất bại');
            return redirect()->route('admin.product.edit',$id);
        }
    }
    
    public function ajax_Product(Request $request) {
        $query = Product::query();
        if ($request->has('search') && !empty($request->search)) {
            $query = $query->where('id', 'like','%'. $request->search.'%')
                ->orWhere('code', 'like','%'. $request->search.'%')
                ->orWhere('name', 'like','%'. $request->search.'%')
                ->orWhere('detail', 'like','%'. $request->search.'%')
                ->orWhere('content', 'like','%'. $request->search.'%')
                ->orWhere('name_vn', 'like','%'. $request->search.'%')
                ->orWhere('detail_vn', 'like','%'. $request->search.'%')
                ->orWhere('content_vn', 'like','%'. $request->search.'%');
                
        }

        if(!empty($request->date_start) && !empty($request->date_end)){
            $date_start = $request->date_start;
            $date_end = $request->date_end;
            $query = $query->whereBetween('created_at', [$date_start, $date_end]);
        }


        if ($request->has('category') && !empty($request->category)) {
            $query = $query->where('collection_id',$request->category);
        }

        if ($request->has('status') && !empty($request->status)) {
            switch ($request->status){
                case 1:
                    $query = $query->where('active_id',1);
                    break;
                case 2:
                    $query = $query->where('active_id',2);
                    break;
            }
        }

        if($request->ajax()){
            $objProduct = $query->orderByDesc('created_at')
                ->paginate(10)
                ->appends(request()->query());
            $view = view('admin.ajax.ajax_product',compact(['objProduct']))->render();
            return response()->json(['view' => $view],200);
        }
        $objProduct = $query->orderByDesc('created_at')->paginate(10)->appends(request()->query());
        return view('admin.product.index',compact('objProduct'));
    }
    
    

}
