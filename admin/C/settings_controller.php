<?php
class settings extends controller
{
    function __construct(){
        parent::__construct();
        $this->view->css = ["admin/css/settings.css"];
        $this->view->js = ["admin/js/settings.js"];
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

        $this->view->user  = $profile->GetLoggedUserData($token)[0];
        $this->view->users = $profile->GetAdminUsers();


          

    }
    public function Autoload($args){
        $this->view->title = "settings-Title";
        $this->view->render("settings/settings_index",true);
    }
    public function admin_users($args)
    {
        $this->view->title = "Admin Users - Staff Panel";
        $this->view->render("settings/settings_index",true);
    }
  
}
?>
  