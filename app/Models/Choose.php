<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Choose extends Model
{
    protected $table = "choose";
    protected $primaryKey = 'id';
    public $timestamps = false;


    public function products() {
        return $this->hasMany('App\Models\Product');
    }

    public function get_Choose() {
    	return $this->all();
    }
  
}

