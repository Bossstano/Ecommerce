<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['stock'];
    //
    public function getprice()
    {
        $price = $this->price / 1000;

        return number_format($price,3,'.',' ').'FCFA';
    }

    public function categories(){

        return $this->belongsToMany('App\Category');
    }

    public function brands(){
        return $this->belongsToMany('App\Brand');
    }
}

