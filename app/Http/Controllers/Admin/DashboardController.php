<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\UserRepositoryInterface;
use App\User;
use Illuminate\Http\Request;
use Session;
class DashboardController extends Controller
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;
    private $data;

    public function __construct(UserRepositoryInterface $userRepository)
    {
         $this->middleware(function ($request, $next) {
            Session::put('top_menu',"dashboard");
            Session::put('sub_menu',"dashboard");
            return $next($request);
        });
         $this->userRepository=$userRepository;
    }
    public function index()
    {
        $this->data['total_active_user']=$this->userRepository->total_active_user();
        $this->data['total_ban_user']=$this->userRepository->total_ban_user();
        $this->data['total_user']=$this->userRepository->total_user();
        return view("admin.dashboard.dashboard",$this->data);
    }
}
