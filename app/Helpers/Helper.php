<?php
namespace App\Helpers;

class Helper{
    // hàm conver key users

   public static function ConverUser($data){

            $users = array();

            foreach($data as $value){
                array_push($users,[
                    'key'                   => $value['id'],
                    'avatar'                => $value['avatar'],
                    'user_name'             => $value['username'],
                    'name'                  => $value['name'],
                    'email'                 => $value['email'],
                    'email_verified_at'     => $value['email_verified_at'],
                    'password'              => $value['password'],
                    'remember_token'        => $value['remember_token'],
                    'login_at'              => $value['login_at'],
                    'change_password_at'    => $value['change_password_at'],
                    'created_at'            => $value['created_at'],
                    'updated_at'            => $value['updated_at']
                ]);
            }

            return $users;
    }

    public static function ConverMenu($data){
        $menus = array();

        foreach($data as $value){
            array_push($menus,[
                'key'           => $value['id'],
                'parent_key'    => $value['parent_id'],
                'name'          => $value['name'],
                'link'          => $value['link'],
                'desc'          => $value['desc'],
                'icon'          => $value['icon'],
                'status'        => $value['status'],
                'created_at'    => $value['created_at'],
                'updated_at'    => $value['updated_at']
            ]);
        }

        return $menus;
    }

    public static function ConverSlider($data) {
        $sliders = array();

        foreach($data as $value){
            array_push($sliders, [
                "key"       => $value['path'],
                "link_src"  => Helper::GoogleUrlImage($value['path']),
                "path"      => $value['path']
            ]);
        }

        return $sliders;
    }

    public static function coverUrlImageGoogle($data) {
        $sliders = array();

        foreach($data as $value){
            array_push($sliders, [
                "image"  => Helper::GoogleUrlImage($value['key_google']),
            ]);
        }

        return $sliders;
    }

   public static function GoogleUrlImage($path){
        return "https://drive.google.com/uc?id=".$path;
    }

}

?>
