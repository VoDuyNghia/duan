<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pages;
use App\Http\Requests\PageRequest;

class PageController extends Controller
{
    public function index() {
    	$objPages = Pages::get();
    	return view('admin.pages.index',compact('objPages'));
    }

    public function get_Add() {
    	return view('admin.pages.add');
    }

    public function post_Add(PageRequest $request) {
    	$objPages = new Pages;
        if($objPages->add_Items($request)){
            $request->session()->flash('msg','Thêm thành công');
            return redirect()->route('admin.pages.index');
        } else {
            $request->session()->flash('msg','Thêm thất bại');
            return redirect()->route('admin.pages.add');
        }
    }

    public function get_Edit($id, Request $request) {
    	$objPages = Pages::findOrfail($id);
    	return view('admin.pages.edit',compact('objPages'));
    }

    public function post_Edit(Request $request,$id) {
    	$objPages = new Pages;
        if($objPages->edit_Items($request,$id)){
            $request->session()->flash('msg','Sửa thành công');
            return redirect()->route('admin.pages.index');
        } else {
            $request->session()->flash('msg','Sửa thất bại');
            return redirect()->route('admin.pages.edit',$id);
        }
    }
}
