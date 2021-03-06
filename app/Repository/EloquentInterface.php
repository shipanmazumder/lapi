<?php


namespace App\Repository;


interface EloquentInterface
{
    public function all();

    public function create(array $data);

    public function findById($id);

    public function update(array $data,$id);

    public function delete($id);
}
