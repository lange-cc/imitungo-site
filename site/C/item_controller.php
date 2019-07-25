<?php
class item extends controller
{
    function __construct(){
        parent::__construct();
        $this->view->css = ["website/tmp/slick-master/slick/slick.css","website/tmp/slick-master/slick/slick-theme.css","website/css/item.css"];
        $this->view->js = ["website/tmp/slick-master/slick/slick.min.js","website/js/item.js"];
        Session::init();
    }
    public function Autoload($args){
      
    }

    public function details($args)
    {
         $id = $args[2];
         $category = $this->LoadModel('category');
         $this->view->category = $category->GetCategory();
         $this->view->category_menu = $category->GetMenuCategory();
         $this->view->offers   = $this->model->GetOffersData();
         $this->view->item =  $this->model->GetItem($id)[0];
         $this->view->title = $this->view->item->name." - Imitungo";
         $this->view->related_items = $this->model->relatedItems($this->view->item->category_id);
         $this->view->render("item/item_index",true);
    }

    public function contact($args)
    {
    

        $userjson = $_POST['data'];
        $user_data  = Form::Data($userjson, false);
       
        if ($this->model->AddUserData($user_data)) {
            $alert = new \stdClass();
            $alert->status = "success";
            $alert->msg = "Now your information is received, We will contact you throught the contact you provided.";
            $info = json_encode($alert);
            echo $info;
        } else {
            $alert = new \stdClass();
            $alert->status = "fail";
            $alert->msg = "Error while submiting.";
            $info = json_encode($alert);
            echo $info;
        }
    }
  
}
?>
  