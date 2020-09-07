<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tree extends Model
{
    public function parent(){
        return $this->belongsTo('App\Tree','parentID');
    }

    public function children(){
        return $this->hasMany('App\Tree','parentID');
    }
}
