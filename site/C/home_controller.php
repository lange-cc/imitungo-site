<?php
class home extends controller
{
    function __construct(){
        parent::__construct();
        $this->view->css = ["website/css/home.css"];
        $this->view->js = ["website/js/home.js"];
        Session::init();
    }
    public function Autoload($args){
        $this->view->title = "Welcome to our website - Imitungo";
        $this->view->recently_items = $this->model->GetRecentlyData();
        $category = $this->LoadModel('category');
        $this->view->category = $category->GetCategory();
        $this->view->category_menu = $category->GetMenuCategory();
        $this->view->popular  = $this->model->GetPopularData();
        $this->view->offers   = $this->model->GetOffersData();
        $this->view->slider   = $this->model->GetSliderContent();
        $this->view->render("home/home_index",true);
    }

    public function search_items($args)
    {
        $keyword = Request::input('keyword');
        $data = $this->model->GetSearchData($keyword);
        echo $data;
    }

    public function submit_offer()
    {

        $productjson = $_POST['product'];
        $product_data  = Form::Data($productjson, false);
        $product_id = $this->model->AddProductData($product_data);

        $userjson = $_POST['user'];
        $user_data  = Form::Data($userjson, false);
        $user_data['product_id'] = $product_id;


        if ($this->model->AddUserData($user_data)) {
            $alert = new \stdClass();
            $alert->status = "success";
            $alert->msg = "Now your information is received wait for confirmation.";
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
  