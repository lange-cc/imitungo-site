<?php

/*
NAME: ABE Jahwin
DATE: 06 MAY 2019
VERSION: 0.1
DESCRIPTION: This controller will be used to create and other staff on client
TASK:
 - Rendering client index page

*/

class clients extends controller
{
    function __construct()
    {
        parent::__construct();
        $this->view->css = ["admin/css/clients.css",'admin/css/client_view.css'];
        $this->view->js = ["admin/js/clients.js"];
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
        $this->dealer($args);
    }

    public function dealer($args){
        $this->view->title = "Clients Dealer - Staff Panel";
        $this->view->render("clients/clients_dealer", true);
    }

    public function buyer($args){
       $this->view->title = "Customer - Staff Panel";
        $this->view->render("clients/clients_customer", true);
    }


    public function get_all_dealer_clients(){
        $data = $this->model->GetClients('dealer');
        if (Request::input('page') != 'null') {
            $page = Request::input('page');
            $paginated_data = $this->paginate($data, 20, $page);
        } else {
            $paginated_data = $this->paginate($data, 20, 1);
        }
        echo json_encode($paginated_data);

    }

    public function get_all_customer_clients($args){
         $data = $this->model->GetClients('customer');
        if (Request::input('page') != 'null') {
            $page = Request::input('page');
            $paginated_data = $this->paginate($data, 20, $page);
        } else {
            $paginated_data = $this->paginate($data, 20, 1);
        }
        echo json_encode($paginated_data);
    }

    public function view_dealer_client($args)
    {
        $id = $args[3];
        $data = $this->model->GetSingleClient($id);
        $this->view->name  = $data[0]->name;
        $this->view->title = $data[0]->name . " - Staff Panel";
        $this->view->data  = $data[0];
        $this->view->item  = $this->model->GetSingleItem($data[0]->product_id)[0];
        $this->view->render("clients/clients_dealer_view", true);
    }

     public function view_customer_client($args)
    {
        $id = $args[3];
        $data = $this->model->GetSingleClient($id);
        $this->view->name  = $data[0]->name;
        $this->view->title = $data[0]->name . " - Staff Panel";
        $this->view->data  = $data[0];
        $this->view->item  = $this->model->GetSingleItem($data[0]->product_id)[0];
        $this->view->render("clients/clients_customer_view", true);
    }

    public function delete_client($args)
    {
        $id = Request::input('id');
        $deleted = $this->model->DeleteClient($id);
        $alert = new \stdClass();
        if ($deleted) {
            $alert->status = "success";
            $alert->msg = "Client was successfully moved to trash";
            $info = json_encode($alert);
            echo $info;
        } else {
            $alert->status = "fail";
            $alert->msg = "Error while moving to trash";
            $info = json_encode($alert);
            echo $info;
        }
    }

public function change_status($args)
    {
        $json = $_POST['data'];
        $id   = $_POST['id'];
        $data = Form::UpdateData($json, false);
        if ($this->model->UpdateClientStatus($id, $data)) {
            $alert = new \stdClass();
            $alert->status = "success";
            $alert->msg    = "Status was successfully changed";
            $info = json_encode($alert);
            echo $info;
        } else {
            $alert = new \stdClass();
            $alert->status = "fail";
            $alert->msg    = "Error while changing";
            $info = json_encode($alert);
            echo $info;
        }
    }



}

?>
  