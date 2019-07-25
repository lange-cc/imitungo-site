<?php

class items_model extends model
{
    // Table name to be used in this model
    protected $table = 'items_tb';
    protected $category_table = 'category_tb';

//================ Category Functions =====================
    public function AddCategoryData($data)
    {
        $save = DB::table($this->category_table)->insert($data);
        if ($save) {
            return true;
        } else {
            return false;
        }
    }

    public function GelAlICategories()
    {
        $data = DB::table($this->category_table)->where('deleted', 'false')->orderBy('id', 'desc')->get();
        return $data;
    }

    public function DeleteCategory($id)
    {
        $deleted = DB::table($this->category_table)->where('id', $id)->update(['deleted' => 'true', 'deleted_at' => $this->Date()]);
        if ($deleted) {
            return true;
        } else {
            return false;
        }
    }

    public function GetSingleCategory($id){
        if (DB::table($this->category_table)->where('id', $id)->exists()) {
            $data = DB::table($this->category_table)->where('id', $id)->get();
            return $data;
        } else {
            return false;
        }
    }

    public function UpdateCategory($id,$data){
        $update = DB::table($this->category_table)->where('id', $id)->update($data);
        if($update){
            return true;
        }else{
            return false;
        }
    }

//=====================================================
    public function AddItemData($data)
    {
        $save = DB::table($this->table)->insert($data);
        if ($save) {
            return true;
        } else {
            return false;
        }
    }

    public function GelAllItems($id)
    {
        $data = DB::table($this->table)->where([['category_id','=', $id],['deleted','=', 'false'],['creator','=', 'admin']])->orderBy('id', 'desc')->get();
        return $data;
    }
    public function DeleteItem($id)
    {
        $deleted = DB::table($this->table)->where('id', $id)->update(['deleted' => 'true', 'deleted_at' => $this->Date()]);
        if ($deleted) {
            return true;
        } else {
            return false;
        }
    }

    public function GetSingleItem($id)
    {
        if (DB::table($this->table)->where('id', $id)->exists()) {
            $data = DB::table($this->table)->where('id', $id)->get();
            return $data;
        } else {
            return false;
        }
    }

    public function UpdateItem($id, $data){
        $update = DB::table($this->table)->where('id', $id)->update($data);
        if($update){
            return true;
        }else{
            return false;
        }
    }
}

?>