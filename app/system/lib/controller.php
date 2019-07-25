<?php

class controller
{
    function __construct(){
        $this->StartView();
}
    public function StartView(){
        if (class_exists('view')) {
            $this->view = new view();
        }else{
            $error = array(
                'Type' => 'Class not found',
                'Message' => "view class  not found in [app/lib/view.php] file",
                'Dir' => "app/lib/view.php",
                'Code' => '0002'
            );
            SYSTEM_ERROR::render_error($error);
        }
    }
    public function LoadControler($controller_name){
        if (ADMIN_FOLDER == URL[0]) {
            if (require ADMIN_FOLDER . '/C/' . $controller_name . '_controller.php') {
                require ADMIN_FOLDER . '/C/' . $controller_name . '_controller.php';
                if (class_exists($controller_name)) {
                    return new $controller_name;
                } else {
                    $error = array(
                        'Type' => 'Class not found',
                        'Message' => $controller_name . "class  not found in [" . ADMIN_FOLDER . "/C/" . $controller_name . "_controller.php] file",
                        'Dir' => ADMIN_FOLDER . "/C/" . $controller_name . "_controller.php",
                        'Code' => '0002'
                    );
                    SYSTEM_ERROR::render_error($error);
                }
            } else {
                $error = array(
                    'Type' => 'File missing',
                    'Message' =>  $controller_name . "_controller.php file not found in [" . ADMIN_FOLDER . "/C]",
                    'Dir' => ADMIN_FOLDER . "/C/",
                    'Code' => '0001'
                );
                SYSTEM_ERROR::render_error($error);
            }
        } elseif (API_FOLDER == URL[0]) {
            if (require API_FOLDER . '/C/' . $controller_name . '_controller.php') {
                require API_FOLDER . '/C/' . $controller_name . '_controller.php';
                if (class_exists($controller_name)) {
                    return new $controller_name;
                } else {
                    $error = array(
                        'Type' => 'Class not found',
                        'Message' => $controller_name . " class  not found in [" . API_FOLDER . "/C/" . $controller_name . "_controller.php] file",
                        'Dir' => API_FOLDER . "/C/" . $controller_name . "_controller.php",
                        'Code' => '0002'
                    );
                    SYSTEM_ERROR::render_error($error);
                }
            } else {
                $error = array(
                    'Type' => 'File missing',
                    'Message' => $controller_name . "_controller.php file not found in [" . API_FOLDER . "/C]",
                    'Dir' => API_FOLDER . "/C/",
                    'Code' => '0001'
                );
                SYSTEM_ERROR::render_error($error);
            }
        } else {
            if (require SITE_FOLDER . '/C/' . $controller_name . '_controller.php') {
                require SITE_FOLDER . '/C/' . $controller_name . '_controller.php';
                if (class_exists($controller_name)) {
                    return new $controller_name;
                } else {
                    $error = array(
                        'Type' => 'Class not found',
                        'Message' => $controller_name . "class  not found in [" . SITE_FOLDER . "/C/" . $controller_name . "_controller.php] file",
                        'Dir' => SITE_FOLDER . "/C/" . $controller_name . "_controller.php",
                        'Code' => '0002'
                    );
                    SYSTEM_ERROR::render_error($error);

                }
            } else {
                $error = array(
                    'Type' => 'File missing',
                    'Message' =>  $controller_name . "_controller.php file not found in [" . SITE_FOLDER . "/C]",
                    'Dir' => SITE_FOLDER . "/C/",
                    'Code' => '0001'
                );
                SYSTEM_ERROR::render_error($error);
            }
        }
    }

    public function LoadModel($model_name){
        $model_name = $model_name.'_model';
        if (ADMIN_FOLDER == URL[0]) {
            if (file_exists(ADMIN_FOLDER . '/M/' . $model_name . '.php')) {
                require ADMIN_FOLDER . '/M/' . $model_name . '.php';
                if (class_exists($model_name)) {
                    return new $model_name;
                } else {
                    $error = array(
                        'Type' => 'Class not found',
                        'Message' => $model_name . "class  not found in [" . ADMIN_FOLDER . "/M/" . $model_name . ".php] file",
                        'Dir' =>  ADMIN_FOLDER . "/M/" . $model_name . ".php",
                        'Code' => '0002'
                    );
                    SYSTEM_ERROR::render_error($error);
                }
            } else {
                $error = array(
                    'Type' => 'File missing',
                    'Message' => $model_name . ".php file not found in [" . ADMIN_FOLDER . "/M]",
                    'Dir' => ADMIN_FOLDER . "/M/",
                    'Code' => '0001'
                );
                SYSTEM_ERROR::render_error($error);
            }
        } elseif (API_FOLDER == URL[0]) {
            if (file_exists(API_FOLDER . '/M/' . $model_name . '.php')) {
                require API_FOLDER . '/M/' . $model_name . '.php';
                if (class_exists($model_name)) {
                    return new $model_name;
                } else {
                    $error = array(
                        'Type' => 'Class not found',
                        'Message' =>  $model_name . "class  not found in [" . API_FOLDER . "/M/" . $model_name . ".php] file",
                        'Dir' =>  API_FOLDER . "/M/" . $model_name . ".php",
                        'Code' => '0002'
                    );
                    SYSTEM_ERROR::render_error($error);
                }
            } else {
                $error = array(
                    'Type' => 'File missing',
                    'Message' => $model_name . ".php file not found in [" . API_FOLDER . "/M]",
                    'Dir' => API_FOLDER . "/M/",
                    'Code' => '0001'
                );
                SYSTEM_ERROR::render_error($error);
            }
        } else {
            if (file_exists(SITE_FOLDER . '/M/' . $model_name . '.php')) {
                require SITE_FOLDER . '/M/' . $model_name . '.php';
                if (class_exists($model_name)) {
                    return new $model_name;
                } else {
                    $error = array(
                        'Type' => 'Class not found',
                        'Message' => $model_name . "class  not found in [" . SITE_FOLDER . "/M/" . $model_name . ".php] file",
                        'Dir' =>  SITE_FOLDER . "/M/" . $model_name . ".php",
                        'Code' => '0002'
                    );
                    SYSTEM_ERROR::render_error($error);
                }
            } else {
                $error = array(
                    'Type' => 'File missing',
                    'Message' => $model_name . ".php file not found in [" . SITE_FOLDER . "/M]",
                    'Dir' => SITE_FOLDER . "/M/",
                    'Code' => '0001'
                );
                SYSTEM_ERROR::render_error($error);
            }
        }
    }

    public function StartUpModel($model_name){
        $model_name = $model_name. '_model';
        if (ADMIN_FOLDER == URL[0]) {
            if (file_exists(ADMIN_FOLDER . '/M/' . $model_name . '.php')) {
                require ADMIN_FOLDER . '/M/' . $model_name . '.php';
                if (class_exists($model_name)) {
                    $this->model =  new $model_name;
                } else {
                    $error = array(
                        'Type' => 'Class not found',
                        'Message' => $model_name . "class  not found in [" . ADMIN_FOLDER . "/M/" . $model_name . ".php] file",
                        'Dir' =>  ADMIN_FOLDER . "/M/" . $model_name . ".php",
                        'Code' => '0002'
                    );
                    SYSTEM_ERROR::render_error($error);
                }
            } else {
                $error = array(
                    'Type' => 'File missing',
                    'Message' => $model_name . ".php file not found in [" . ADMIN_FOLDER . "/M]",
                    'Dir' => ADMIN_FOLDER . "/M/",
                    'Code' => '0001'
                );
                SYSTEM_ERROR::render_error($error);
            }
        } elseif (API_FOLDER == URL[0]) {
            if (file_exists(API_FOLDER . '/M/' . $model_name . '.php')) {
                require API_FOLDER . '/M/' . $model_name . '.php';
                if (class_exists($model_name)) {
                    $this->model =   new $model_name;
                } else {
                    $error = array(
                        'Type' => 'Class not found',
                        'Message' =>  $model_name . "class  not found in [" . API_FOLDER . "/M/" . $model_name . ".php] file",
                        'Dir' =>  API_FOLDER . "/M/" . $model_name . ".php",
                        'Code' => '0002'
                    );
                    SYSTEM_ERROR::render_error($error);
                }
            } else {
                $error = array(
                    'Type' => 'File missing',
                    'Message' => $model_name . ".php file not found in [" . API_FOLDER . "/M]",
                    'Dir' => API_FOLDER . "/M/",
                    'Code' => '0001'
                );
                SYSTEM_ERROR::render_error($error);
            }
        } else {
            if (file_exists(SITE_FOLDER . '/M/' . $model_name . '.php')) {
                require SITE_FOLDER . '/M/' . $model_name . '.php';
                if (class_exists($model_name)) {
                    $this->model =  new $model_name;
                } else {
                    $error = array(
                        'Type' => 'Class not found',
                        'Message' => $model_name . "class  not found in [" . SITE_FOLDER . "/M/" . $model_name . ".php] file",
                        'Dir' =>  SITE_FOLDER . "/M/" . $model_name . ".php",
                        'Code' => '0002'
                    );
                    SYSTEM_ERROR::render_error($error);
                }
            } else {
                $error = array(
                    'Type' => 'File missing',
                    'Message' => $model_name . ".php file not found in [" . SITE_FOLDER . "/M]",
                    'Dir' => SITE_FOLDER . "/M/",
                    'Code' => '0001'
                );
                SYSTEM_ERROR::render_error($error);
            }
        }
    }

    public function GetErrorPage($url,$folder,$controller_name){
        if (file_exists($folder . '/C/' . $controller_name . '_controller.php')) {
            require $folder. '/C/' . $controller_name . '_controller.php';
            // Function to check if class exist
            if (class_exists($controller_name)) {
                $controller = new $controller_name;
                $this->model = $controller->StartUpModel($controller_name);
                $method = method_exists($controller, "Autoload");
                if ($method) {
                    $controller->Autoload($url);
                } else {
                    $error = array(
                        'Type' => 'Function not found',
                        'Message' => "Function autoload is missing in " . $controller_name . " class   in [" . $folder . "/C/" . $controller_name . "_controller.php] file",
                        'Dir' => $folder. "/C/" . $controller_name . "_controller.php",
                        'Code' => '0003'
                    );
                    SYSTEM_ERROR::render_special_error($error);
                }

            } else {
                $error = array(
                    'Type' => 'Class not found',
                    'Message' => $controller_name . " class  not found in [" . $folder. "/C/" . $controller_name . "_controller.php] file",
                    'Dir' => $folder . "/C/" . $controller_name . "_controller.php",
                    'Code' => '0002'
                );
                SYSTEM_ERROR::render_special_error($error);
            }
        } else {
                $error = array(
                    'Type' => 'File missing',
                    'Message' => $controller_name . "_controller.php file not found in [" . $folder . "/C]",
                    'Dir' => $folder . "/C/",
                    'Code' => '0001'
                );
                SYSTEM_ERROR::render_special_error($error);

        }
    }

    public function paginate($data,$item_toShow,$page){
        $Totaltems = count($data);
        $totalPage  =   ceil($Totaltems / $item_toShow);
        if($page <= $totalPage && $page > 0 ){
        if(($page-1) < 0 ){
            $PreviewsPage = null;
        }else{
            if($page == 1){
                $PreviewsPage = null;
            }else{
                $PreviewsPage = $page-1;
            }
        }
        if(($page+1) > $totalPage ){
            $NextPage = null;
        }else{
            $NextPage = $page+1;
        }

        $StartItem = ($page * $item_toShow) - $item_toShow;
        if($Totaltems >  $page * $item_toShow) {
            $EndItem = $page * $item_toShow;
            }else{
            $EndItem =$StartItem + $Totaltems - (($page * $item_toShow) - $item_toShow);
        }

        $new_data = array();
        for($i =$StartItem;  $i<$EndItem; $i++){
            array_push($new_data,$data[$i]);
        }

        $info = array(
            "totalItems"  =>  $Totaltems,
            "StartItem" =>  $StartItem,
            "EndItem"  =>  $EndItem,
            "TotalPage" => $totalPage,
            "CurrentlyPage" => $page,
            "PreviewsPage" => $PreviewsPage,
            "NextPage" => $NextPage,
            "data" => $new_data
        );
        return $info;
    }
    return null;
    }
    public function GetToken($length = 8){
        $characters = 'cxbvjhuy78erfuwir8ycnkljafGHVHFCFGbnjvgfjfdbvgjhfuie74378321465125utrhgehfthuirfhtrghuit4hgt6juuinrjkgthh564652622656haslkdjhusghcyuabedfuhywegfbwefrheeevgfuihfih4rgterjPONJBVghnjgklnmjfkbvgjdkfbvgjdfvhdfvbfgdnhFSESOKOM230peihurfg4uihfgbvddxdcfp';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function IsAuth(){
if(Request::input('auth') != null) {
    if (Session::init()->Get('auth-token') == Request::input('auth')) {
        return true;
    } else {
        return false;
    }
}else{
    return false;
}
    }
public function Date(){
        return  date('Y-m-d H:i:s');
}
public function Redirect($url){
        echo ' <script> window.location.href =" '.$url.'";</script>';
}
public function GetLoginToken(){
    if(Cookies::Get('admin_login_token') != null){
        $token = Cookies::Get('admin_login_token');
    }elseif ( Session::init()->get('admin_login_token') != null){
        $token =  Session::init()->get('admin_login_token');
    }else{
        $token = null;
    }
    return $token;
}
}

?>