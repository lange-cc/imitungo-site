<?php
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "/$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$actual_link = rtrim($actual_link,'/');
$actual_link = explode("/",$actual_link);
if($actual_link[1] == "localhost" || $actual_link[1] == "127.0.0.1"){
    $link =  $actual_link[0]."://".$actual_link[1]."/".$actual_link[2]."/";
}else{
    $actual_link =  (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $link = rtrim($actual_link,'/')."/";
}

$actual_link2 = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$url = parse_url($actual_link2);
$path = $url['path'] ;
if( $url['host'] == "localhost" || $url['host'] == "127.0.0.1" ) {
    $prefix = '/';
    if (substr($path, 0, strlen($prefix)) == $prefix) {
        $path = substr($path, strlen($prefix));
    }
}
$url = explode("/",$path);
$new_url ="";
foreach ($url as $key => $value){
    $key = $key+1;
    if($key  < count($url)) {
        $new_url .= $url[$key]."/";
    }
}

if ($new_url == "/") {
    $url = SITE_START_PAGE;
} else {
    $url = $new_url;
}
$url = rtrim($url, '/');
$url = explode('/', $url);
$root = $link;
if($url[0] == ADMIN_FOLDER){
    $link =  $link.ADMIN_FOLDER."/";
}elseif($url[0] == API_FOLDER){
   // Do nothing: Don't put any code here
}elseif($url[0] == 'dev'){
    define("DEV_ASSETS", $link."app/system/dev/public/");
    $link   =  $link."dev/";
}else{
    $link =  $link;
}