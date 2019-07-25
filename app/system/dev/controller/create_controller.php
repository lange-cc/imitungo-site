<?php

class create extends dev_controller
{
    function __construct()
    {
        parent::__construct();
        $this->view->css = array('css/create.css');
        $this->view->js = array('js/create.js');
    }

    public function Autoload($url)
    {
        $this->view->title = "Create page";
        $this->view->render('create/index', true);
    }
public function  Create_Template($page,$type,$folder){
    $controller = $page . '_controller.php';
    $model = $page . '_model.php';
    $controller_location = $folder . '/C/' . $controller;
    if (!file_exists($controller_location)) {

// ====================================================================
        $controller_content = '<?php
class ' . $page . ' extends controller
{
    function __construct(){
        parent::__construct();
        $this->view->css = ["'.$type.'/css/' . $page . '.css"];
        $this->view->js = ["'.$type.'/js/' . $page . '.js"];
        Session::init();
    }
    public function Autoload($args){
        $this->view->title = "' . $page . '-Title";
        $this->view->render("' . $page . '/' . $page . '_index",true);
    }
  
}
?>
  ';
        file_put_contents($controller_location, $controller_content);
//  ========================================================================
// ========================================================================
        $model_location = $folder. '/M/' . $model;
        $model_content = '<?php
class ' . $page . '_model extends model{
    // Table name to be used in this model
    protected $table = "' . $page . '_' . DB_PREFIX . '";
//=====================================================

}
?>
  ';
        file_put_contents($model_location, $model_content);
//  ========================================================================

// ========================================================================
        $view_location = $folder. '/V/' . $page . '';
        mkdir($view_location);
        $view_content = ' <h1 style="text-align: center" > Welcome to  ' . $page . ' page</h1> ';
        file_put_contents($view_location.'/'.$page . '_index.php', $view_content);
//  ========================================================================
        file_put_contents('assets/'.$type.'/css/'.$page . '.css', "");
        $js_content = 'var web_url = document.getElementById("LINK").value;
var  '.$page.'  = new Vue({
        el: "#html-element",
        data: {
            url: web_url,
            valiable: null,
        },
        mounted() {
                 // Codes .............
        },
        methods: {
            Test : function(){
                let formData = new FormData();
                formData.append("page", this.valiable);

                axios.post(this.url+"page/function",formData).then(function(response){
                    if (response.data != null) {
                          if(response.data.status == "success"){
                               // Codes .............
                         }else{
                             // Codes .............
                          }
                    }
                });
            },
        }

    });
     ';
        file_put_contents('assets/'.$type.'/js/'.$page . '.js', $js_content);
//=========================================================================
        $proced = new \stdClass();
        $proced->status = "success";
        $proced->message = "Now page is successfully created";
        $myJSON = json_encode($proced);
        echo $myJSON;

    } else {
        $proced = new \stdClass();
        $proced->status = "fail";
        $proced->message = "File you are trying to create is already exist";
        $myJSON = json_encode($proced);
        echo $myJSON;
    }
}
    public function page($url)
    {
        if (isset($_POST['page'])) {
            if (!empty($_POST['page'])) {
                $page = AllCharLower($_POST['page']);
                $type = $_POST['type'];
                if ($type == 'admin') {
                    $this->Create_Template($page,$type,ADMIN_FOLDER);
                } elseif ($type == 'website') {
                    $this->Create_Template($page,$type,SITE_FOLDER);
                } else{
                    $proced = new \stdClass();
                    $proced->status = "fail";
                    $proced->message = "Invalid Selection";
                    $myJSON = json_encode($proced);
                    echo $myJSON;
                }

            } else {
                $proced = new \stdClass();
                $proced->status = "fail";
                $proced->message = "Please enter your page name";
                $myJSON = json_encode($proced);
                echo $myJSON;
            }
        }
    }
}

?>