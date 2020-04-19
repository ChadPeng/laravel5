<?php

namespace App\Http\Repositories;

use App\Http\Models\click108;
use App\Http\Models\click108_info;
use App\Http\Models\click108_name;
use App\Http\Models\click108_type;
use DB;
use Illuminate\Support\Carbon;
use Log;
use Throwable;

class Click108Repository extends BaseRepository
{
    private $myModel;

    public function __construct()
    {
        $model = new click108;
        $info = new click108_info;
        $type = new click108_type;
        $name = new click108_name;
        $this->myModel = ['main'=>$model , 'info'=>$info , 'type'=>$type , 'name'=>$name];
    }

    public function addMainData(){
        $this->model = $this->myModel['main'];
        $result = $this->single_add('date' , Carbon::now()->toDateString());
        return $result->id;
    }

    public function getType(){
        $this->model = $this->myModel['type'];
        return $this->get()->keyBy('id');
    }

    public function getName(){
        $this->model = $this->myModel['name'];
        return $this->get()->keyBy('click108_name');
    }

    public function createClick108($data){
        try {
            DB::transaction(function () use ($data) {
                $mainId = $this->addMainData();
                $this->addInfo($mainId , $data);
            });
            return true;
        } catch (Throwable $e) {
            Log::error($e);
            return false;
        }
    }

    public function addInfo($id , $data){
        $this->model = $this->myModel['info'];

        foreach ($data as $key => $value){
            foreach ($value as $k => $item){
                $tempArray = ['click108_id'=>$id , 'click108_name_id'=>$key , 'type'=>$k , 'star'=>$item['title'] , 'star_count'=>$item['star'] , 'info'=>$item['info']];
                $this->add($tempArray);
            }
        }

    }
}
