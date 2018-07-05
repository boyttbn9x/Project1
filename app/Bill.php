<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = 'bill';

    public function users(){
    	return $this->belongsTo('App\User');
    }

    public function tour(){
    	return $this->belongsTo('App\Tour');
    }
}
