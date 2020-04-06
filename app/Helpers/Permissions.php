<?php


namespace App\Helpers;


use App\Http\Controllers\API\AuthController;

class Permissions
{
    private $users;
    public function __construct()
    {
    }
    public static function hasPermission(string  $module,string $type)
    {
        $role_name=auth()->user()->role->name;
        if($role_name=="Admin")
        {
            return true;
        }
        elseif ($role_name=="Moderator")
        {
            if($type=="is_delete" || $type=="is_ban")
            {
                return false;
            }
            return true;
        }
        return false;
    }
    public static function checkPermission(string $module,string $type)
    {
        if(Permissions::hasPermission($module,$type) == true)
        {
            return true;
        }
        return response()->json([
                'success'   =>  false,
                 'message'=>"You have no permission"
            ], 200);
    }
}
