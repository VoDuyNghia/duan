<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = "slider";
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

}

