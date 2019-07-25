<?php
class profile extends controller
{
    function __construct(){
        parent::__construct();
        $this->view->css = ["admin/css/profile.css"];
        $this->view->js = ["admin/js/profile.js"];
        Session::init();
    }
    public function Autoload($args){
        $this->view->title = "profile-Title";
        $this->view->render("profile/profile_index",true);
    }

    public function update_user($args)
    {
        $json = $_POST['data'];
        $data = Form::Data($json, false);
        $token = $this->GetLoginToken();
        if ($this->model->UpdateUserInfo($data,$token)) {
            $alert = new \stdClass();
            $alert->status = "success";
            $alert->msg = "Information updated";
            $info = json_encode($alert);
            echo $info;
        } else {
            $alert = new \stdClass();
            $alert->status = "fail";
            $alert->msg = "Error while updating";
            $info = json_encode($alert);
            echo $info;
        }
    }

    public function add_new_user($args)
    {
        $json = $_POST['data'];
        $data = Form::Data($json, false);
        $pass = password_hash($data['password'], PASSWORD_DEFAULT);
        $data['password'] = $pass;
        if ($this->model->AddUserData($data)) {
            $alert = new \stdClass();
            $alert->status = "success";
            $alert->msg = "User was successfully added";
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

   public function get_single_user($args)
   {
       $id = Request::input('id');
       echo $this->model->find($id);
   }

   public function update_user_data($args)
   {
        $json = $_POST['data'];
        $id   = $_POST['id'];
        $data = Form::UpdateData($json, false);
        $pass = password_hash($data['password'], PASSWORD_DEFAULT);
        $data['password'] = $pass;

        if ($this->model->UpdateUser($id, $data)) {
            $alert = new \stdClass();
            $alert->status = "success";
            $alert->msg    = "User was successfully Updated";
            $info          = json_encode($alert);
            echo $info;
        } else {
            $alert = new \stdClass();
            $alert->status = "fail";
            $alert->msg    = "Error while updating User";
            $info          = json_encode($alert);
            echo $info;
        }
   }
}
?>
  