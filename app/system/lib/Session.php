<?php
class Session
{
    private  static $instance;
    public static function init(){
        if(session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        self::$instance = new self();
        return self::$instance;
    }
    public static function Add($key,$value){
        $_SESSION[$key] = $value;
        return true;
    }

    public static function Get($key){
        if(!isset($_SESSION[$key])) {
            return null;
            }
            return $_SESSION[$key];
    }

    public static function Delete($key){
        if(!isset($_SESSION[$key])) {
            return false;
        }
            unset($_SESSION[$key]);
            return true;
    }
    public static function destroy(){
        session_destroy();
        return true;
    }
}
?>