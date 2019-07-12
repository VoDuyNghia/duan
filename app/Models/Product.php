<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    protected $table = "product";
    protected $primaryKey = 'id';
    public $timestamps = false;


    protected $fillable = ['name', 'detail', 'content', 'image', 'price ', 'choose_id', 'collection_id', 'district_id', 'users_id', 'address', 'configuration', 'active'];


    public function contact() {
        return $this->hasMany('App\Models\Contact');
    }


    public function slider()
    {
        return $this->belongsToMany('App\Models\Slider');
    }


    public function collection (){
        return $this->belongsTo('App\Models\Collection','collection_id','id');
    }


    public function choose (){
        return $this->belongsTo('App\Models\Choose','choose_id','id');
    }

    public function status (){
        return $this->belongsTo('App\Models\Status','status_id','id');
    }

    public function district (){
        return $this->belongsTo('App\Models\District','district_id','id');
    }


    public function add_Items($request){
        $data                       = $request->all();
        if(isset($data['configuration'])) {
            $configuration          = json_encode($data['configuration']);
            $data['configuration']  = $configuration;
        } else {
            $configuration          = null;
        }
        
        if(isset($data['configuration_vn'])) {
            $configuration_vn       = json_encode($data['configuration_vn']);
            $data['configuration_vn']= $configuration_vn;
        } else {
            $configuration_vn          = null;
        }

        $this->code                 = $data['code'];
        $this->name                 = $data['name'];
        $this->name_vn              = $data['name_vn'];
        $this->detail               = $data['detail'];
        $this->detail_vn            = $data['detail_vn'];
        $this->content              = $data['description'];
        $this->content_vn           = $data['description_vn'];
        $this->price                = $data['price'];
        $this->choose_id            = $data['choose_id'];
        $this->status_id            = $data['status_id'];
        $this->collection_id        = $data['collection_id'];
        $this->district_id          = $data['district_id'];
        $this->users_id             = Auth::user()->id;
        $this->address              = $data['address'];
        $this->configuration        = $configuration;
        $this->configuration_vn     = $configuration_vn;
        $this->bedrooms             = $data['bedrooms'];
        $this->bathrooms            = $data['bathrooms'];
        $this->sqrt                 = $data['sqrt'];
        $this->active_id            = $data['active'];
        $this->image                = $request->fileName;

        return $this->save();
    }

    public function post_Edit($request ,$id) {
        $objItem                    = $this->findOrFail($id);
        
        $images123 = $request->file('image_detail123');
        if($images123){
            $oldimage123 = $_SERVER["DOCUMENT_ROOT"]. '/public/image/files/show_image/'.$objItem['image'];
            if(file_exists($oldimage123)) {
                unlink($oldimage123);
            }
        }
        // Xóa ảnh chi tiết
        $images_del = $request->id_del_image;
        if(!empty($images_del)){
            $array_img = explode(',',$images_del);
            foreach($array_img as $id_del){
                $img  = ImageDetail::find($id_del);
                $path = $_SERVER["DOCUMENT_ROOT"].'/public/image/files/detail_image/'.$img->image_detail;
                if(file_exists($path)){
                    unlink($path);
                }
                $img->delete();
            }
        }

        $data = $request->all();
        if(isset($data['configuration'])) {
            $configuration              = json_encode($data['configuration']);
            $data['configuration']      = $configuration;
        } else {
            $configuration              = null;
        }
        
        if(isset($data['configuration_vn'])) {
            $configuration_vn           = json_encode($data['configuration_vn']);
            $data['configuration_vn']   = $configuration_vn;
        } else {
            $configuration_vn           = null;
        }



        $objItem->code              = $data['code'];
        $objItem->name              = $data['name'];
        $objItem->detail            = $data['detail'];
        $objItem->content           = $data['description'];
        $objItem->price             = $data['price'];
        $objItem->choose_id         = $data['choose_id'];
        $objItem->status_id         = $data['status_id'];
        $objItem->collection_id     = $data['collection_id'];
        $objItem->district_id       = $data['district_id'];
        $objItem->users_id          = Auth::user()->id;
        $objItem->address           = $data['address'];
        $objItem->configuration     = $configuration;
        $objItem->configuration_vn  = $configuration_vn;
        $objItem->bedrooms          = $data['bedrooms'];
        $objItem->bathrooms         = $data['bathrooms'];
        $objItem->sqrt              = $data['sqrt'];
        $objItem->active_id         = $data['active'];
        $objItem->image             = $request->fileName;


        return $objItem->save();
    }
}

