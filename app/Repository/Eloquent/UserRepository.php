<?php


namespace App\Repository\Eloquent;


use App\Helpers\Permissions;
use App\Repository\EloquentInterface;
use App\Repository\UserRepositoryInterface;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface,EloquentInterface
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

    public function total_ban_user()
    {
        // TODO: Implement total_ban_user() method.
        return User::where("is_ban",false)->count();
    }

    public function total_active_user()
    {
        // TODO: Implement total_active_user() method.
        return User::where("is_ban",true)->count();
    }

    public function total_user()
    {
        // TODO: Implement total_user() method.
        return User::where("role_id","=",3)->count();
    }

    public function pagination($search_key, $filter)
    {
        // TODO: Implement pagination() method.
        $users=User::orderBy("id","desc")->with("role")->where("role_id",3);
        if($filter!='')
        {
            $users=$users->where('is_ban',$filter);
        }
        if($search_key!='')
        {
            $users=$users->where('email', 'like', '%' . $search_key . '%');
        }
        return $users->paginate(10);
    }
}
