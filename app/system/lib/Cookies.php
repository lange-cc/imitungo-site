<?php
class Cookies
{

    public static function Add($key,$value,$day){
        setcookie($key, $value, time() + (86400 * $day), "/"); // 86400 = 1 day
        return true;
    }

    public static function Get($key){
        if(!isset($_COOKIE[$key])) {
            return null;
        }
        return $_COOKIE[$key];
    }

    public static function Delete($key){
        if(!isset($_COOKIE[$key])) {
            return false;
        }
        setcookie("user", "", time() - 3600);
        return true;
    }

    public static function Check(){
        setcookie("test_cookie", "test", time() + 3600, '/');
        if(count($_COOKIE) > 0) {
            return true;
        } else {
            return false;
        }
    }

}
?>