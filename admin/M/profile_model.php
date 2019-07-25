<?php
class profile_model extends model{
    // Table name to be used in this model
    protected $table = "admin_user";
//=====================================================

    public function GetLoggedUserData($token)
    {
       $data =  DB::table($this->table)->where([['login_token','=',$token]])->get();
       return $data;
    }

    public function UpdateUserInfo($data,$token)
    {
       $save = DB::table($this->table)->where('login_token', $token)->update($data);
        if ($save) {
            return true;
        } else {
            return false;
        }
    }

    public function AddUserData($data)
    {
        $save = DB::table($this->table)->insert($data);
        if ($save) {
            return true;
        } else {
            return false;
        }
    }

  public function GetAdminUsers()
    {
       $data =  DB::table($this->table)->get();
       return $data;
    }

 public function UpdateUser($id, $data)
    {
       $save = DB::table($this->table)->where('id', $id)->update($data);
        if ($save) {
            return true;
        } else {
            return false;
        }
    }



}
?>
  