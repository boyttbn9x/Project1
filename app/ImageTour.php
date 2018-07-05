<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageTour extends Model
{
    protected $table = 'imagetour';

    public function tour(){
    	return $this -> belongsTo('App\Tour');
    }
}
