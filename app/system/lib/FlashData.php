<?php
class FlashData{
    public static function Add($key,$data){
        session_start();
        if(!isset($_SESSION[$key])){
            $_SESSION[$key] = array();
        }
        array_push($_SESSION[$key],$data);
        return true;
    }
    public static function Get($key){
        session_start();
        if(!isset($_SESSION[$key])){
            return null;
        }
        $data = $_SESSION[$key];
        unset( $_SESSION[$key]);
        return $data;
}
}