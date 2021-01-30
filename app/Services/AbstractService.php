<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractService implements ServiceInterface
{
    protected $model_name;

    /**
     * AbstractService constructor.
     * @param string $model_name
     */
    public function __construct(string $model_name)
    {
        $this->model_name = $model_name;
    }

    /**
     * 新規作成する
     *
     * @param $params
     * @return Builder|Model|object|null
     */
    public function create($params)
    {
        $model = new $this->model_name();

        $model->fill($params)->save();

        return $model;
    }

    /**
     * 更新する
     *
     * @param $id
     * @param $params
     * @return Builder|Model|object|null
     */
    public function update($id, $params)
    {
        $model = $this->getById($id);

        $model->fill($params)->save();

        return $model;
    }

    /**
     * 削除する
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->model_name::where('id', $id)
            ->delete();
    }

    /**
     * IDから取得する
     *
     * @param $id
     * @return Builder|Model|object|null
     */
    public function getById($id)
    {
        return $this->model_name::find($id);
    }

    /**
     * 全件取得する
     *
     * @return Builder[]|Collection
     */
    public function getAll()
    {
        return $this->model_name::get();
    }

    /**
     * 一部だけ取得するクエリ構築
     *
     * @param $skip
     * @param $take
     * @return mixed
     */
    public function skipTakeQuery($skip, $take)
    {
        return $this->model_name::skip($skip)
            ->take($take);
    }

    /**
     * 一部だけ取得する
     *
     * @param $skip
     * @param $take
     * @return Builder[]|Collection|mixed
     */
    public function skipTake($skip, $take)
    {
        return $this->skipTakeQuery($skip, $take)
            ->get();
    }
}
