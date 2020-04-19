<?php

namespace App\Http\Repositories;

class BaseRepository
{
    protected $model;

    /**
     * 新增
     * @param array $data
     * @return mixed
     */
    public function add(array $data)
    {
        $model = $this->model->newInstance();
        foreach ($data as $column => $value) {
            $model->$column = $value;
        }
        $model->save();
        return $model;
    }

    public function single_add($column , $value)
    {
        $model = $this->model->newInstance();
        $model->$column = $value;
        $model->save();

        return $model;
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function get()
    {
        return $this->model->get();
    }

    public function update($id,$data)
    {
        $gift = $this->model->find($id);
        foreach ($data as $column => $value) {
            $gift->$column = $value;
        }

        return $gift->save();
    }

    public function delete($id){
        return $this->model->find($id)->delete();
    }

}
