<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = "district";
    protected $primaryKey = 'id';
    public $timestamps = false;


    public function products() {
        return $this->hasMany('App\Models\Product');
    }

    public function get_District() {
    	return $this->all();
    }
  
}

