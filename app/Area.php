<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
	protected $fillable = ['name','description'];
    public function workers(){
        return $this->hasMany('App\Worker');
    }
}
