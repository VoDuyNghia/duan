<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Active extends Model
{
    protected $table = "active";
    protected $primaryKey = 'id';
    public $timestamps = false;


    public function products() {
        return $this->hasMany('App\Models\Product');
    }


    public function news() {
        return $this->hasMany('App\Models\News');
    }

    public function get_Active() {
    	return $this->all();
    }
  
}

