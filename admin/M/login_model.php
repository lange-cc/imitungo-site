<?php

class login_model extends model{
    // Table name to be used in this model
    protected $table = 'admin_user';
//=====================================================
public function CheckUser($email,$password){
    $user =  DB::table('admin_user')->where([['username','=',$email]])->exists();
    if($user){
        $user =  DB::table('admin_user')->select('password')->where([['username','=',$email]])->get();
        $hashed_password = $user[0]->password;
        if(password_verify($password, $hashed_password)) {
           return true;
        }
    }
    return false;
}
public function SaveLoginSession($email,$password,$token,$date){
   return   DB::table('admin_user')->where([['username','=',$email]])->update(['login_token' => $token,'last_login' => $date]);
}
public function GetUserName($email,$password){
    return   DB::table('admin_user')->select('names')->where([['username','=',$email]])->get();
}
public function CheckLogin($token){
    return DB::table('admin_user')->where([['login_token','=',$token]])->exists();
}
public function  RemoveUserToken($token){
    return   DB::table('admin_user')->where([['login_token','=',$token]])->update(['login_token' => '']);
}
}
?>