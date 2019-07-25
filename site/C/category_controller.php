<?php
class category extends controller
{
    function __construct(){
        parent::__construct();
        $this->view->css = ["website/css/category.css"];
        $this->view->js = ["website/js/category.js"];
        Session::init();
    }
    public function Autoload($args){
        
    }
    public function view_item($args)
    {
        $id= $args[2];
        
        $this->view->category = $this->model->GetCategory();
        $this->view->category_menu = $this->model->GetMenuCategory();
        $this->view->items = $this->model->GetCategoryItems($id);
        $name = $this->model->GetCategoryName($id)[0]->name;
        $this->view->title = $name." - Imitungo";
        $this->view->render("category/category_index",true);
    }


  
}
?>
  