<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diadiem extends Model
{
    protected $table = 'diadiem';

    public function tour(){
    	return $this->hasMany('App\Tour');
    }

     public function user(){
    	return $this->belongsTo('App\User');
    }
}
