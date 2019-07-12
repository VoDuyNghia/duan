<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Http\Requests\CollectionRequest;
use Illuminate\Support\Facades\DB;

class CatController extends Controller
{

    public function __construct(Collection $objCollection){
        $this->objCollection = $objCollection;
    }


    public function index() {
        $objCollection =$this->objCollection->get_Collection();
    	$title = "Danh Sách | Danh Mục";
    	return view("admin.cat.index",compact('title','objCollection'));
    }


    public function get_Add() {
        return view("admin.cat.add");
    }

    public function post_Add(CollectionRequest $request) {

	 	try {
            DB::beginTransaction();
            if($this->objCollection->add_Collection($request)) {
				$request->session()->flash('msg','Thêm thành công!');
				DB::commit();
            	return redirect()->route('admin.cat.index');
            } else {
                DB::rollBack();
            	$request->session()->flash('msg','Thêm thất bại');
            	return redirect()->route('admin.cat.add');
            }
    	} catch(\Exception $e) {
    		DB::rollBack();
            $request->session()->flash('msg','Thêm thất bại');
        	return redirect()->route('admin.cat.add');
    	}
    }

    public function get_Edit($id) {
        $objItem = $this->objCollection->get_Item($id);
        return view('admin.cat.edit',compact('objItem'));
    }

    public function post_Edit($id, CollectionRequest $request) {
        try {
            DB::beginTransaction();
            if($this->objCollection->edit_Collection($id, $request)){
                $request->session()->flash('msg','Sửa thành công!');
                DB::commit();
                return redirect()->route('admin.cat.index');
            } else {
                DB::rollBack();
                $request->session()->flash('msg','Sửa thất bại');
                return redirect()->route('admin.cat.edit',$id);
            }
        } catch(\Exception $e) {
            DB::rollBack();
            $request->session()->flash('msg','Sửa thất bại');
            return redirect()->route('admin.cat.edit',$id);
        }
    }

    public function post_Delete(Request $request) {
        try {
            $deletedRows = Collection::where('id', $request->id)->delete();
            return response()->json(['success'=> 'Xóa thành công!']);
        } catch(\Exception $e) {
            DB::rollBack();
            return response()->json(['error'=> 'Xóa thất bại!']);

        }
    }
}
