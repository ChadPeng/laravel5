<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class click108 extends Model
{
    public function info(){
        return $this->hasMany(click108_info::class, 'click108_id');
    }
}
