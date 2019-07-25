<?php
class home extends dev_controller{
     function __construct()
     {
         parent::__construct();
          $this->view->css = array('css/home.css');
     }
     public function Autoload($url){
         $this->view->title = "Welcome to dev system";
         $this->view->render('home/index',false);
     }
}
?>