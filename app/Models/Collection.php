<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $table = "collection";
    protected $primaryKey = 'id';
    public $timestamps = false;


    protected $fillable = ['name','name_ascii','position'];

    public function products() {
        return $this->hasMany('App\Models\Product');
    }
    
    public function get_Collection() {
    	return $this->all();
    }
    public function add_Collection($request) {
        $this->name             = $request->name_category;
		$this->name_vn 			= $request->name_category_vn;
    	$this->name_ascii 		= str_slug($request->name_category);
    	$this->position 		= $request->position;

    	return $this->save();
    }
    

    public function get_Item($id) {
    	return $this->findOrFail($id);
    }


    public function edit_Collection ($id , $request){
        
    	$objCollection 				= $this->findOrFail($id);
        $objCollection->name        = $request->name_category;
        $objCollection->name_vn	    = $request->name_category_vn;
    	$objCollection->name_ascii 	= str_slug($request->name_category);
    	$objCollection->position 	= $request->position;

    	return $objCollection->save();
    }
}

