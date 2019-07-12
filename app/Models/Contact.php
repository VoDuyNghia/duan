<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = "contact";
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function product (){
        return $this->belongsTo('App\Models\Product','product_id','id');
    }


    public function add_Items($request,$id){
        $data = $request->all();
    	$this->name 		=  $data['username'];
    	$this->phone 		=  $data['phone'];
    	$this->email 		=  $data['email'];
        $this->product_id   =  $id;
    	$this->message      =  $data['message'];
        return $this->save();
    }
}

