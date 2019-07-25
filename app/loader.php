<?php
/**
 * Date: 20/12/2018
 * Time: 22:11
 */

$config = [
    "constant",
    "path"
];


$packages = [
    "P_database/autoload",
    "p_dom/autoload",
    "p_php_jquel/autoload"
];

$libs = [
    "database",
    "Functions",
    "Upload",
    "Session",
    "Cookies",
    "FlashData",
    "model",
    "lang",
    "HTTPRequest",
    "form",
    "SongsEngine",
    "view",
    "controller"
];


/**
 * ============================================================================================
 * ============================================================================================
 * ============================================================================================
 * ============================================================================================
 **============================================================================================
 * ============================================================================================
 * ============================================================================================
 * ============================================================================================
 * ============================================================================================
 * ============================================================================================
 * ============================================================================================
 * ============================================================================================
 * ============================================================================================
 * ============================================================================================
 * ============================================================================================
 * ============================================================================================
 **============================================================================================
 * ============================================================================================
 * ============================================================================================
 * ============================================================================================
 * ============================================================================================
 * ============================================================================================
 * ============================================================================================
 * ============================================================================================
 */

foreach ($config as $file) {
    if (file_exists("app/config/".$file.".php")) {
        //Loading config file
        if($file == "constant") {
            require "app/config/" . $file . ".php";
            require_once "app/system/lib/path_helper.php";
        }else{
            require "app/config/" . $file . ".php";
        }
    } else {
        $error = array(
            'Type'         => 'File missing',
            'Message' => "<b>".$file."</b> configuration file does not found, Error in loading file in app/config folder.",
            'Dir'            => 'app/config/',
            'Code'        => '0001'
        );
        SYSTEM_ERROR::render_error($error);
    }
}


foreach ($packages as $package) {
    if (file_exists("app/system/packages/".$package.".php")) {
        //Loading lib file
        require "app/system/packages/".$package.".php";
    } else {

        $pack_name  = explode("/",$package);
        $pack_name  =  $pack_name[0];
        $error = array(
            'Type'         => 'File missing',
            'Message' => "<b>".$pack_name."</b> package library  does not found in app/system/packages/".$pack_name." folder.",
            'Dir'            => "app/system/packages/".$pack_name,
            'Code'        => '0001'
        );
        SYSTEM_ERROR::render_error($error);
    }
}



foreach ($libs as $lib) {
    if (file_exists("app/system/lib/".$lib.".php")) {
        //Loading lib file
        require "app/system/lib/".$lib.".php";
    } else {
        $error = array(
            'Type'         => 'File missing',
            'Message' => "<b>".$lib."</b>  library file does not found, Error in loading file in [app/system/lib] folder.",
            'Dir'            => 'app/system/lib/',
            'Code'        => '0001'
        );
        SYSTEM_ERROR::render_error($error);
    }
}

// Loading system engine
if (file_exists("app/system/lib/engine.php")) {
    //Loading engine file
    require 'app/system/lib/engine.php';
   $engine =  new engine();
   $engine->getUrl();
} else {
    $error = array(
        'Type'         => 'File missing',
        'Message' =>  "Engine file does not found, Error in loading Engine file in [app/system/lib] folder.",
        'Dir'            => 'app/system/lib/',
        'Code'        => '0001'
    );
    SYSTEM_ERROR::render_error($error);
}

