<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = "status";
    protected $primaryKey = 'id';
    public $timestamps = false;


    public function products() {
        return $this->hasMany('App\Models\Product');
    }

    public function get_Status() {
    	return $this->all();
    }
  
}

