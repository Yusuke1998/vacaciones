<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    public function area(){
        return $this->belongsTo('App\Area');
    }

    public function vacations(){
        return $this->hasMany('App\Vacation');
    }

    public function scopeSearch($query, $search){
        if($search){
            return $query->where('name','LIKE',"%$search%")
            ->orWhere('ci','LIKE',"%$search%")
            ->orWhere('date_in','LIKE',"%$search%")
            ->orWhere('date_out','LIKE',"%$search%")
            ->orWhere('position','LIKE',"%$search%")
            ->orWhere('email','LIKE',"%$search%")
            ->orWhere('cellphone','LIKE',"%$search%");
        }
    }

}
