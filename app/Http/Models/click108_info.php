<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class click108_info extends Model
{
    public function type(){
        return $this->hasOne(click108_type::class, 'type');
    }

    public function name(){
        return $this->hasOne(click108_name::class, 'click108_name_id');
    }

    public function main(){
        return $this->belongsTo(click108::class , 'click108_id');
    }
}
