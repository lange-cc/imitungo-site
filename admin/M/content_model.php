<?php
class content_model extends model{
    // Table name to be used in this model
    protected $articles_tb = "articles_tb";
    protected $table = "articles_tb";
//=====================================================

public function AddContentData($data)
{
    $save = DB::table($this->articles_tb)->insert($data);
        if ($save) {
            return true;
        } else {
            return false;
        }
}

public function GetAllContent()
{
    $data = DB::table($this->articles_tb)->where('deleted', 'false')->get();
    return $data;
}

public function DeleteContent($id)
{
    $deleted = DB::table($this->articles_tb)->where('id', $id)->update(['deleted' => 'true', 'deleted_at' => $this->Date()]);
        if ($deleted) {
            return true;
        } else {
            return false;
        }
}

public function UpdateContent($id, $data)
{
    $update = DB::table($this->table)->where('id', $id)->update($data);
        if($update){
            return true;
        }else{
            return false;
        }
}

}
?>
  