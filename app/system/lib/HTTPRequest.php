<?php
/**
 * Date: 08/01/2019
 * Time: 07:11
 */
class Request{

    public static function input($input){
        if(isset($_POST[$input])) {
            if (!empty($_POST[$input])) {
                $data = $_POST[$input];
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }else{
                return null;
            }
        }else{
            return null;
        }
    }
    public static function method(){
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            return "POST";
        }elseif ($_SERVER['REQUEST_METHOD'] == "GET"){
            return "GET";
        }elseif ($_SERVER['REQUEST_METHOD'] == "PUT"){
            return "PUT";
        }elseif ($_SERVER['REQUEST_METHOD'] == "DELETE"){
            return "DELETE";
        }
    }
}

?>