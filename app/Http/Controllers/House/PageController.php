<?php

namespace App\Http\Controllers\House;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pages;
use Session;

class PageController extends Controller
{
    public function about_us() {
    	if (session::get('locale') == "en") {
    		$title          = "ABOUT US | DA NANG RESIDENCE";
            $description    = "DA NANG RESIDENCE will help you find the house for rent, apartment for rent, villa for rent in Da Nang as rapidly as possible. With many years experience in property rental, DA NANG RESIDENCE is a trustable place for expats in Da Nang to find rental properties.";
    	} else {
    		$title          = "VỀ CHÚNG TÔI | DA NANG RESIDENCE";
            $description    = "DA NANG RESIDENCE sẽ giúp bạn tìm nhà cho thuê, căn hộ cho thuê, biệt thự cho thuê tại Đà Nẵng càng nhanh càng tốt. Với nhiều năm kinh nghiệm trong việc cho thuê bất động sản, DA NANG RESIDENCE là nơi đáng tin cậy cho người nước ngoài ở Đà Nẵng để tìm tài sản cho thuê.";
    	}
        
        $key_word  = "";
        $objPages  = Pages::where('id', '1')->first();
    	return view('house.page.about',compact('title','key_word','objPages'))->with('key_word', '')->with('key_word', '')->with('district','')->with('collection','')->with('choose','')->with('bedrooms','')->with('bathrooms','')->with('title',$title)->with('description',$description)->with('image',asset('templates/house/img/bg-img/logo.jpg'));
    }
}
