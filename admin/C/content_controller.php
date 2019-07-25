<?php
class content extends controller
{
    function __construct(){
        parent::__construct();
        $this->view->css = ["admin/css/content.css"];
        $this->view->js = ["admin/js/content.js"];
        
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
    public function Autoload($args){
        $this->view->title = "Content - Staff Panel";
        $this->view->content = $this->model->GetAllContent();
        $this->view->render("content/content_index",true);
    }

    public function add_new_content($args)
    {
        $json = $_POST['data'];
        $data = Form::Data($json, false);
        if ($this->model->AddContentData($data)) {
            $alert = new \stdClass();
            $alert->status = "success";
            $alert->msg = "Content was successfully added";
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

    
    public function get_all_content($args)
    {
        $data = $this->model->GetAllContent();
        return $data;
    }

    public function delete_content($args)
    {
        $id = Request::input('id');
        $deleted = $this->model->DeleteContent($id);
        $alert = new \stdClass();
        if ($deleted) {
            $alert->status = "success";
            $alert->msg = "Content was successfully moved to trash";
            $info = json_encode($alert);
            echo $info;
        } else {
            $alert->status = "fail";
            $alert->msg = "Error while moving to trash";
            $info = json_encode($alert);
            echo $info;
        }
    }

    public function get_single_content()
    {
        $id = Request::input('id');
        if (Form::IsNumber($id)) {
            $data = $this->model->find($id);
            if ($data) {
                echo json_encode($data);
            } else {
                echo null;
            }
        } else {
            echo null;
        }
    }

    public function update_content(){
    $json = $_POST['data'];   
    $id =   $_POST['id'];
    $data = Form::UpdateData($json, false);
    if ($this->model->UpdateContent($id, $data)) {
        $alert = new \stdClass();
        $alert->status = "success";
        $alert->msg = "Content was successfully Updated";
        $info = json_encode($alert);
        echo $info;
    } else {
        $alert = new \stdClass();
        $alert->status = "fail";
        $alert->msg = "Error while updating content";
        $info = json_encode($alert);
        echo $info;
    }
    }

  
}
?>
  