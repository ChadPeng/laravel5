<?php

namespace App\Http\Repositories;

use App\Http\Models\click108;
use DB;
use Cache;

class Click108Repository extends BaseRepository
{
    function __construct(click108 $model)
    {
        $this->model = $model;
    }
}
