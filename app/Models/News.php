<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class News extends Model
{
    protected $table = "news";
    protected $primaryKey = 'id';
    public $timestamps = false;


    protected $fillable = ['name', 'detail', 'content', 'image', 'active_id ', 'user_id'];


    public function user (){
        return $this->belongsTo('App\User','user_id','id');
    }


    public function active (){
        return $this->belongsTo('App\Models\Active','active_id','id');
        
    }


    public function add_Items($request){
        $data = $request->all();
        if(!isset($data['address'])) {
            $data['address'] = null;
        }
        $this->name                 = $data['name'];
        $this->name_vn              = $data['name_vn'];
        $this->detail               = $data['detail'];
        $this->detail_vn            = $data['detail_vn'];
        $this->content              = $data['description'];
        $this->content_vn           = $data['description_vn'];
        $this->address              = $data['address'];
        // $this->address_vn           = $data['address_vn'];
        $this->user_id              = Auth::user()->id;
        $this->active_id            = $data['active'];
        $this->image                = $request->fileName;

        return $this->save();
    }

    public function post_Edit($request,$id) {
        $data                       = $request->all();
        if(!isset($data['address'])) {
            $data['address'] = null;
        }
        $objItem                    = $this->findOrFail($id);
        
 
        
        $images123 = $request->file('image_detail123');
        if($images123){
            $oldimage123 = $_SERVER["DOCUMENT_ROOT"]. '/public/image/files/show_news/'.$objItem['image'];
            if(file_exists($oldimage123)) {
                unlink($oldimage123);
            };
        }

        $objItem->name              = $data['name'];
        $objItem->name_vn           = $data['name_vn'];
        $objItem->detail            = $data['detail'];
        $objItem->detail_vn         = $data['detail_vn'];
        $objItem->content           = $data['description'];
        $objItem->content_vn        = $data['description_vn'];
        $objItem->active_id         = $data['active'];
        $objItem->address           = $data['address'];
        // $objItem->address_vn        = $data['address_vn'];
        $objItem->image             = $request->fileName;
        return $objItem->save();
    }
}

