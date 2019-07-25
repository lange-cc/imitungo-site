<?php
class login extends controller{
    function __construct(){
        parent::__construct();
        $this->view->css = [];
        $this->view->js    = ['admin/js/login.js'];
        Session::init();
    }
    public function Autoload($args){
        $this->view->title = 'Login - Dashboard';
        $this->LoginCheck();
    }
    public function LoginCheck(){
        $token = $this->GetLoginToken();
        if($token != null) {
            if($this->model->CheckLogin($token)) {
                $this->Redirect(LINK . 'clients');
            }else{
                $this->view->render("login/login_index", false);
            }
        }else {
            $this->view->render("login/login_index", false);
        }
    }
    public function user($args)
    {
        if (Request::method() == "POST") {
            if ($this->IsAuth() == true) {
                $email = Request::input('username');
                $password = Request::input('password');
                $remember = Request::input('keep');
                $date = $this->Date();
                if (Form::isEmail($email)) {
                    if ($remember == "true") {
                        //for session and cookies
                        if ($this->model->CheckUser($email, $password)) {
                            //User exist
                            $token = $this->GetToken(80);
                            if ($this->model->SaveLoginSession($email, $password, $token, $date)) {
                                Cookies::Add('admin_login_token', $token, 5);
                                Session::init()->Add('admin_login_token', $token);
                                $user = $this->model->GetUserName($email, $password);
                                $alert = new \stdClass();
                                $alert->status = "success";
                                $alert->message = "Welcome " . $user[0]->names;
                                $info = json_encode($alert);
                                echo $info;
                            }
                        } else {
                            //|user not Exist
                            $alert = new \stdClass();
                            $alert->status = "fail";
                            $alert->message = "Username or password are incorrect";
                            $info = json_encode($alert);
                            echo $info;
                        }
                    } else {
                        // for session only
                        if ($this->model->CheckUser($email, $password)) {
                            //User exist
                            $token = $this->GetToken(80);
                            if ($this->model->SaveLoginSession($email, $password, $token,$date)) {
                                Cookies::Delete('admin_login_token');
                                Session::init()->Add('admin_login_token', $token);
                                $user = $this->model->GetUserName($email, $password);
                                $alert = new \stdClass();
                                $alert->status = "success";
                                $alert->message = "Welcome " . $user[0]->names;
                                $info = json_encode($alert);
                                echo $info;
                            }
                        } else {
                            //|user not Exist
                            $alert = new \stdClass();
                            $alert->status = "fail";
                            $alert->message = "Username or password are incorrect";
                            $info = json_encode($alert);
                            echo $info;
                        }
                    }
                } else {
                    $alert = new \stdClass();
                    $alert->status = "fail";
                    $alert->message = "Your email is incorrect";
                    $info = json_encode($alert);
                    echo $info;
                }
            }else{
                $alert = new \stdClass();
                $alert->status = "fail";
                $alert->message = "You are not allowed";
                $info = json_encode($alert);
                echo $info;
            }
        }
    }
    public function forgot_password($args){
        $this->view->title = 'Forgot Password - Dashboard ';
        $this->view->render("login/login_forgot",false);
    }
    public function change_password($args){
        $this->view->title = 'Change Password - Dashboard ';
        $this->view->render("login/login_pass_changer",false);
    }
    public function logout(){
        $this->view->title = 'Login - Dashboard';
        $token = Cookies::Get('admin_login_token');
        if($this->model->RemoveUserToken($token)){
            Cookies::Delete('admin_login_token');
            Session::init()->Delete('admin_login_token');
            $this->view->render("login/login_index", false);
        }else{
            $this->view->render("login/login_index", false);
        }

    }
}
?>