<?php
/**
 * Date: 20/12/2018
 * Time: 22:10
 */
//error_reporting(0);
if(file_exists("app/system/helper/error_helper.php")){
    require "app/system/helper/error_helper.php";
}else{
    echo "File error_helper.php not found in [app/system/helper]";
}

// Checking if loader file are exist
if (file_exists( __DIR__ ."/app/loader.php")) {
    //Loading loader file
    require  __DIR__ .'/app/loader.php';
} else {
    $error = array(
        'Type'         => 'File missing',
        'Message' =>  "Loader file does not found in app folder.",
        'Dir'            => 'app/',
        'Code'        => '0001'
    );
    SYSTEM_ERROR::render_error($error);
}

SYSTEM_ERROR::PHP_error();

?>