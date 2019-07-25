<?php

class items extends controller
{
    function __construct()
    {
        parent::__construct();
        $this->view->css = ['admin/css/items.css', 'admin/css/items_view.css'];
        $this->view->js = ['admin/js/items.js'];

        $profile = $this->LoadModel('profile');
        $token = $this->GetLoginToken();
        if($token != null) {
            $login = $this->LoadModel('login');
            if($login->CheckLogin($token)) {
               
            }else{
                $this->Redirect(LINK . 'login');
            }
        }else {
             $this->Redirect(LINK . 'login');
        }

        $this->view->user = $profile->GetLoggedUserData($token)[0];
    }

    public function Autoload($args)
    {
        $this->view->title = "Manage items - Staff Panel";
        $this->view->render("items/items_index", true);
    }

//    ========================= Category Functions ==========================
    public function add_new_category($args)
    {
        $json = $_POST['data'];
        $data = Form::Data($json, false);
        if ($this->model->AddCategoryData($data)) {
            $alert = new \stdClass();
            $alert->status = "success";
            $alert->msg = "Category was successfully added";
            $info = json_encode($alert);
            echo $info;
        } else {
            $alert = new \stdClass();
            $alert->status = "fail";
            $alert->msg = "Error while saving";
            $info = json_encode($alert);
            echo $info;
        }
    }

    public function get_all_category($args)
    {
        $data = $this->model->GelAlICategories();
        if (Request::input('page') != 'null') {
            $page = Request::input('page');
            $paginated_data = $this->paginate($data, 20, $page);
        } else {
            $paginated_data = $this->paginate($data, 20, 1);
        }
        echo json_encode($paginated_data);
    }

    public function delete_category($args)
    {
        $id = Request::input('id');
        $deleted = $this->model->DeleteCategory($id);
        $alert = new \stdClass();
        if ($deleted) {
            $alert->status = "success";
            $alert->msg = "Category was successfully moved to trash";
            $info = json_encode($alert);
            echo $info;
        } else {
            $alert->status = "fail";
            $alert->msg = "Error while moving to trash";
            $info = json_encode($alert);
            echo $info;
        }
    }

    public function get_single_category()
    {
        $id = Request::input('id');
        if (Form::IsNumber($id)) {
            $data = $this->model->GetSingleCategory($id);
            if ($data) {
                echo json_encode($data);
            } else {
                echo null;
            }
        } else {
            echo null;
        }
    }

    public function update_category()
    {
        $json = $_POST['data'];
        $id = $_POST['id'];
        $data = Form:: UpdateData($json, true);
        if ($this->model->UpdateCategory($id, $data)) {
            $alert = new \stdClass();
            $alert->status = "success";
            $alert->msg = "Category was successfully Updated";
            $info = json_encode($alert);
            echo $info;
        } else {
            $alert = new \stdClass();
            $alert->status = "fail";
            $alert->msg = "Error while updating Category";
            $info = json_encode($alert);
            echo $info;
        }
    }

    public function view_category($args)
    {
        $id = $args[4];
        $data = $this->model->GetSingleCategory($id);
        $this->view->category_id = $id;
        $this->view->category_name = $data[0]->name;
        $this->view->title = $data[0]->name . " - Staff Panel";
        $this->view->render("items/items_category_view", true);

    }

//    ====================================================================


    public function add_new_item($args)
    {
        $json = $_POST['data'];
        $data = Form::Data($json, false);
        if ($this->model->AddItemData($data)) {
            $alert = new \stdClass();
            $alert->status = "success";
            $alert->msg = "Item was successfully added";
            $info = json_encode($alert);
            echo $info;
        } else {
            $alert = new \stdClass();
            $alert->status = "fail";
            $alert->msg = "Error while saving";
            $info = json_encode($alert);
            echo $info;
        }
    }


    public function get_all_items($args)
    {
        $id = Request::input('id');
        $data = $this->model->GelAllItems($id);
        if (Request::input('page') != 'null') {
            $page = Request::input('page');
            $paginated_data = $this->paginate($data, 20, $page);
        } else {
            $paginated_data = $this->paginate($data, 20, 1);
        }
        echo json_encode($paginated_data);
    }


    public function delete_item()
    {
        $id = Request::input('id');
        $deleted = $this->model->DeleteItem($id);
        $alert = new \stdClass();
        if ($deleted) {
            $alert->status = "success";
            $alert->msg = "Item was successfully moved to trash";
            $info = json_encode($alert);
            echo $info;
        } else {
            $alert->status = "fail";
            $alert->msg = "Error while moving to trash";
            $info = json_encode($alert);
            echo $info;
        }
    }

    public function get_single_item($args)
    {
        $id = Request::input('id');
        if (Form::IsNumber($id)) {
            $data = $this->model->GetSingleItem($id);
            if ($data) {
                echo json_encode($data);
            } else {
                echo null;
            }
        } else {
            echo null;
        }
    }

    public function update_item()
    {
        $json = $_POST['data'];
        $id = $_POST['id'];
        $data = Form:: UpdateData($json, true);
        if ($this->model->UpdateItem($id, $data)) {
            $alert = new \stdClass();
            $alert->status = "success";
            $alert->msg = "Item was successfully Updated";
            $info = json_encode($alert);
            echo $info;
        } else {
            $alert = new \stdClass();
            $alert->status = "fail";
            $alert->msg = "Error while updating item";
            $info = json_encode($alert);
            echo $info;
        }
    }

    public function view_item($args)
    {
        $id = $args[3];
        $data = $this->model->GetSingleItem($id);
        $this->view->name = $data[0]->name;
        $this->view->title = $data[0]->name . " - Staff Panel";
        $this->view->item = $data[0];
        $this->view->render("items/items_view", true);
    }
}

?>