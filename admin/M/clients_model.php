<?php
class clients_model extends model{
    // Table name to be used in this model
    protected $table  = "clients_tb";
     protected $clients_table = "items_tb";
//=====================================================

public function GetClients($type){
    $data = DB::table($this->table)->where([['deleted','=','false'],['type','=',$type]])->get();
    return $data;
}
public function DeleteClient($id){
    $deleted = DB::table($this->table)->where('id', $id)->update(['deleted' => 'true','deleted_at'=>$this->Date()]);
    if($deleted){
        return true;
    }else{
        return false;
    }
}
public function GetSingleClient($id){
    if(DB::table($this->table)->where('id', $id)->exists()){
        $data = DB::table($this->table)->where('id', $id)->get();
        return $data;
    }else{
        return false;
    }
}

public function GetSingleItem($id){
        if (DB::table($this->clients_table)->where('id', $id)->exists()) {
            $data = DB::table($this->clients_table)->where('id', $id)->get();
            return $data;
        } else {
            return false;
        }
    }
public function UpdateClientStatus($id, $data){
     $update = DB::table($this->clients_table)->where('id', $id)->update($data);
        if($update){
            return true;
        }else{
            return false;
        }
}



}
?>
  