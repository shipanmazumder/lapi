<?php

namespace App\Http\Controllers\API;

use App\Helpers\Permissions;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationFormRequest;
use App\Repository\UserRepositoryInterface;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository=$userRepository;
    }
    public function index()
    {
        $users=$this->userRepository->all();
         return response()->json([
            'success'   =>  true,
            'data'      =>  $users
        ], 200);
    }
    public function register(RegistrationFormRequest $request)
    {
        $user=$this->userRepository->create($request->all());
         return response()->json([
            'success'   =>  true,
            'data'      =>  $user
        ], 200);
    }

    public function show($id)
    {
        $user= $this->userRepository->findById($id);
         return response()->json([
            'success'   =>  true,
            'data'      =>  $user
        ], 200);
    }

    public function update(RegistrationFormRequest $request,$id)
    {
        if(!Permissions::hasPermission("users",config('app.can_update')))
        {
            return response()->json([
                'success'   =>  false,
                'message'      =>  'You have no permission'
            ], 200);
        }
        $user=$this->userRepository->update($request->all(),$id);
         return response()->json([
            'success'   =>  true,
            'data'      =>  $user
        ], 200);
    }
    public function destory($id)
    {
       if(!Permissions::hasPermission("users",config('app.can_delete')))
        {
            return response()->json([
                'success'   =>  false,
                'message'      =>  'You have no permission'
            ], 200);
        }
         $user=$this->userRepository->delete($id);
         return response()->json([
            'success'   =>  true,
            'data'      =>  $user
        ], 200);
    }

    public function ban($id)
    {
        if(!Permissions::hasPermission("users",config('app.can_ban')))
        {
            return response()->json([
                'success'   =>  false,
                'message'      =>  'You have no permission'
            ], 200);
        }

         $user=$this->userRepository->ban($id);
         return response()->json([
            'success'   =>  true,
            'data'      =>  $user
        ], 200);
    }
}
