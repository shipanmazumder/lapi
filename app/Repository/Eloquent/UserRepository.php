<?php


namespace App\Repository\Eloquent;


use App\Helpers\Permissions;
use App\Repository\UserRepositoryInterface;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{

    public function all()
    {
        // TODO: Implement all() method.
        return User::whereNotIn("role_id",[1,2])->get();
    }

    public function create(array $data)
    {
       return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'role_id' => $data['role_id'],
                'password' => Hash::make($data['password']),
            ]);
    }
    public function findById($id)
    {
        // TODO: Implement findById() method.
        return User::findOrFail($id);
    }

    public function update(array $data, $id)
    {
        $user=$this->findById($id);
        $user->name=$data['name'];
        $user->email=$data['email'];
        $user->role_id=$data['role_id'];
        if(isset($data['password']) || $data['password']!='')
            $user->password=Hash::make($data['password']);
        else
            $user->password=$user->password;

        $user->save();
        return $user;
    }

    public function delete($id)
    {
        return User::destroy($id);
    }

    public function ban($id)
    {
        $user=$this->findById($id);
        if($user->is_ban==true)
        {
            $user->is_ban=false;
        }else{
             $user->is_ban=true;
        }
        $user->save();
        return $user;
    }
}
