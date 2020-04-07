<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Permissions;
use App\Helpers\Util;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationFormRequest;
use App\Repository\RoleRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Http\Request;
use Session;
class UserController extends Controller
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
         $this->middleware(function ($request, $next) {
            Session::put('top_menu',"user");
            Session::put('sub_menu',"user");
            return $next($request);
        });
         $this->userRepository=$userRepository;
    }
    public function index()
    {

        return view("admin.users.users");
    }

    public function view()
    {
        $search_key=request()->input("search_key");
        $filter_by=request()->input("filter_by");

        $this->data['users']=$this->userRepository->pagination($search_key,$filter_by);
         $page=request()->input('page');
        if($page<=1)
        {
            $this->data['sl_counter']=1;
        }
        else
        {
            $this->data['sl_counter']=$page*10-9;
        }
        $returnHTML = view('admin.users.users_data')->with($this->data)->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }

   public function register(RegistrationFormRequest $request)
    {
        $user=$this->userRepository->create($request->all());

        Util::setMessage("message","success","Successfully");
        return redirect()->route("admin.user");
    }
    public function userEdit($user_id,RoleRepositoryInterface $roleRepository)
    {
        $this->data['single']=$this->userRepository->findById($user_id);
        $this->data['roles']=$roleRepository->all();
        $this->data['edit']=true;
        return view('admin.users.users',$this->data);

    }
    public function update(RegistrationFormRequest $request,$id)
    {
        if(!Permissions::hasPermission("users","can_update"))
        {
            Util::setMessage("message","warning","You have no permission");
            return redirect()->route("admin.dashboard");
        }
        $user=$this->userRepository->update($request->all(),$id);
        Util::setMessage("message","success","Successfully");
        return redirect()->route("admin.user");

    }
    public function destory($id)
    {
       if(!Permissions::hasPermission("users",config('app.can_delete')))
        {
            Util::setMessage("message","warning","You have no permission");
           return redirect()->route("admin.dashboard");
        }
         $user=$this->userRepository->delete($id);
        Util::setMessage("message","success","Successfully");
        return redirect()->route("admin.user");
    }

    public function ban($id)
    {
        if(!Permissions::hasPermission("users","can_ban"))
        {
            Util::setMessage("message","warning","You have no permission");
            return redirect()->route("admin.dashboard");
        }

         $user=$this->userRepository->ban($id);
        Util::setMessage("message","success","Successfully");
        return redirect()->route("admin.user");
    }
}
