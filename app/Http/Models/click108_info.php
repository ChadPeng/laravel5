<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class click108_info extends Model
{
    public function type108(){
        return $this->hasOne(click108_type::class, 'id' , 'type');
    }

    public function name(){
        return $this->hasOne(click108_name::class, 'id' , 'click108_name_id');
    }

    public function main(){
        return $this->belongsTo(click108::class ,'click108_id' ,'id');
    }
}
