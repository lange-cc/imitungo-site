<?php

/**
 * Class view help to control templating task
 */
class view
{
    function __construct(){
        Session::init();
    }

    public function render($path, $footer_header = false){
         $this-> LoadTemplete($path, $footer_header);
    }
    public function LoadTemplete($path, $footer_header = false){
      // Load template in admin section ===========================
        if (ADMIN_FOLDER == URL[0]) {
            if ($footer_header == false) {
                if(file_exists(ADMIN_FOLDER .'/V/' . $path . '.php')){
                    require ADMIN_FOLDER .'/V/' . $path . '.php';
                }else{
                    $error = array(
                        'Type' => 'File missing',
                        'Message' =>   'Body file to render not found in ['.ADMIN_FOLDER .'/V/' . $path . '.php]',
                        'Dir' => ADMIN_FOLDER .'/V/' . explode("/",$path)[0]."/",
                        'Code' => '0001'
                    );
                    SYSTEM_ERROR::render_error($error);
                }

            } else {
                if(file_exists(ADMIN_FOLDER .'/V/pages/header.php') && file_exists(ADMIN_FOLDER .'/V/' .  $path . '.php') && file_exists(ADMIN_FOLDER .'/V/pages/footer.php') ){
                    require  ADMIN_FOLDER .'/V/pages/header.php';
                    if(FOR_ADMIN ){
                    require  'app/system/content/page_helper/admin/css_assets.php';
                    if(A_DISPLAY_ON == "header"){
                        require  'app/system/content/page_helper/admin/js_assets.php';
                    }}
                    require  ADMIN_FOLDER .'/V/' .  $path . '.php';
                    if(FOR_ADMIN ){
                    if(A_DISPLAY_ON == "footer"){
                        require  'app/system/content/page_helper/admin/js_assets.php';
                    }}
                    require  ADMIN_FOLDER .'/V/pages/footer.php';
                } else {
                    $error = array(
                        'Type' => 'File missing',
                        'Message' =>   'Header, Body and Footer files  to render one of them not found in ['.ADMIN_FOLDER .'/V/pages/]',
                        'Dir' => ADMIN_FOLDER .'/V/pages/',
                        'Code' => '0001'
                    );
                    SYSTEM_ERROR::render_error($error);
                }
            }

            // Load api template ==================================
        } elseif (API_FOLDER == URL[0]) {
                echo "Api does not have template";
        } else {
            // Load site template ==================================
            if ($footer_header == false) {
                if(file_exists(SITE_FOLDER .'/V/' . $path . '.php')){
                    require SITE_FOLDER .'/V/' . $path . '.php';
                }else{
                    $error = array(
                        'Type' => 'File missing',
                        'Message' =>   'Body file to render not found in ['.SITE_FOLDER .'/V/' . $path . '.php]',
                        'Dir' => SITE_FOLDER .'/V/' . explode("/",$path)[0]."/",
                        'Code' => '0001'
                    );
                    SYSTEM_ERROR::render_error($error);
                }
            } else {
                if(file_exists(SITE_FOLDER .'/V/pages/header.php') && file_exists(SITE_FOLDER .'/V/' .  $path . '.php') && file_exists(SITE_FOLDER .'/V/pages/footer.php') ){
                    require  SITE_FOLDER .'/V/pages/header.php';
                    if(FOR_WEBSITE){
                        require  'app/system/content/page_helper/site/css_assets.php';
                    if(DISPLAY_ON == "header"){
                        require  'app/system/content/page_helper/site/js_assets.php';
                    }}
                    require  SITE_FOLDER .'/V/' .  $path . '.php';
                    if(FOR_WEBSITE){
                    if(DISPLAY_ON == "footer"){
                        require  'app/system/content/page_helper/site/js_assets.php';
                    }}
                    require  SITE_FOLDER .'/V/pages/footer.php';
                } else {
                    $error = array(
                        'Type' => 'File missing',
                        'Message' =>   'Header, Body and Footer files  to render one of them not found in ['.SITE_FOLDER .'/V/pages/]',
                        'Dir' => SITE_FOLDER .'/V/pages/',
                        'Code' => '0001'
                    );
                    SYSTEM_ERROR::render_error($error);

                }
            }
        }
    }
    public function GetTitle(){
        if (isset($this->title)){
            return $this->title;
        }else{
            return "No title";
        }
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

    public function Auth(){
        $token = $this->GetToken(60);
        Session::Add('auth-token',$token);
        $data = ' <input id="auth" type="hidden" value="'.$token.'" name="auth" v-model="credentials.auth = \''.$token.'\' ">';
        return $data;
    }

}

?>