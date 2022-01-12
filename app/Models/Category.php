<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Category extends Model

{
    protected $guarded = [];



public function products(){
    return $this->belongsToMany('App\Models\Product', 'category_product');

}

public function childs(){
    return $this->hasMany('App\Models\Category','parent_id','id');
}

public function parent(){
    return $this->belongsTo('App\Models\Category');
}
public function getRouteKeyName(){
    return 'slug';
}

}
