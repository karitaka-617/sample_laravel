<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ServiceInterface
{
    /**
     * 新規作成する
     *
     * @param $params
     * @return Builder|Model|object|null
     */
    public function create($params);

    /**
     * 更新する
     *
     * @param $id
     * @param $params
     * @return Builder|Model|object|null
     */
    public function update($id, $params);

    /**
     * 削除する
     *
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * IDから取得する
     *
     * @param $id
     * @return Builder|Model|object|null
     */
    public function getById($id);

    /**
     * 全件取得する
     *
     * @return Builder[]|Collection
     */
    public function getAll();

    /**
     * 一部取得するクエリの構築
     *
     * @param $skip
     * @param $take
     * @return mixed
     */
    public function skipTakeQuery($skip, $take);

    /**
     * 一部取得する
     *
     * @param $skip
     * @param $take
     * @return Builder[]|Collection
     */
    public function skipTake($skip, $take);
}
