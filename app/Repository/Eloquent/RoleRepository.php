<?php


namespace App\Repository\Eloquent;


use App\Repository\EloquentInterface;
use App\Repository\RoleRepositoryInterface;
use App\Role;

class RoleRepository implements EloquentInterface,RoleRepositoryInterface
{

    public function all()
    {
        // TODO: Implement all() method.
        return Role::all();
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
    }

    public function findById($id)
    {
        // TODO: Implement findById() method.
    }

    public function update(array $data, $id)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}
