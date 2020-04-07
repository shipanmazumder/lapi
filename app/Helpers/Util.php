<?php


namespace App\Helpers;


class Util
{
     public static  function set_Topmenu($top_menu_name) {
        $session_top_menu = session('top_menu');
        if ($session_top_menu == $top_menu_name) {
            return 'active';
        }
        return "";
    }

    public static  function set_Submenu($sub_menu_name) {
        $session_sub_menu = session('sub_menu');
        if ($session_sub_menu == $sub_menu_name) {
            return 'active';
        }
        return "";
    }
     public static function setMessage($key,$class,$message) {
       session()->flash($key, $message);
       session()->flash("class", $class);
        // session()->flash($key,'<div class="alert alert-'.$class.'">'.$message.'</div>');
        return true;
    }
}
