<?php

class SYSTEM_ERROR
{
    public static function render_error($Error)
    {
        require_once "app/config/constant.php";
        require_once "app/config/path.php";
        if (DEVELOPMENT == true) {
            SYSTEM_ERROR::API_Error($Error);
            require_once "app/system/content/error_viewer/index.php";
        } else {
            SYSTEM_ERROR::LoadWebErrorPage();
            exit;
        }
    }

    public static function API_Error($error){
        if (defined('URL')) {
            if (URL[0] == API_FOLDER) {
                echo json_encode($error);
                exit;
            }
        }
}

    public static function render_special_error($Error)
    {
        require_once "app/config/constant.php";
        require_once "app/config/path.php";
        if (DEVELOPMENT == false) {
            SYSTEM_ERROR::API_Error($Error);
            require_once "app/system/content/error_viewer/index.php";
        } else {
            SYSTEM_ERROR::LoadWebErrorPage();
            exit;
        }
    }

    public static function LoadWebErrorPage(){
          echo "ERROR FOUND BUT YOU ARE IN PRODUCTION MODE";
    }

    public static function display_error($error)
    {
        if (isset($error)) {
            echo $error;
        } else {
            echo "This Text not found";
        }
    }
    public static function PHP_error(){
        if(error_get_last() != null) {
            $get_error = error_get_last();
            $error = array(
                'Type' => ' PHP error found',
                'Message' => '<b>' . $get_error['message'] . '</b>. Go and see on bellow directory on line ' . $get_error['line'] . ' to fix that error.',
                'Dir' => $get_error['file'],
                'Code' => '000' . $get_error['type']
            );
            if ($get_error['type'] != 8){
                SYSTEM_ERROR::API_Error($error);
                SYSTEM_ERROR::render_error($error);
        }
        }
    }
}

?>