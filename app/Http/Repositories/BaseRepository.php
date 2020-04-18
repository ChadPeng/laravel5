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
    function add(array $data)
    {
        $model = $this->model->newInstance();
        foreach ($data as $cloumn => $value) {
            $model->$cloumn = $value;
        }
        $model->save();
        return $model;
    }

    function find($id)
    {
        return $this->model->find($id);
    }

    function get()
    {
        return $this->model->get();
    }

    function update($id,$data)
    {
        $gift = $this->model->find($id);
        foreach ($data as $cloumn => $value) {
            $gift->$cloumn = $value;
        }

        return $gift->save();
    }

    function delete($id){
        return $this->model->find($id)->delete();
    }

}
