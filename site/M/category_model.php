<?php
class category_model extends model{
    // Table name to be used in this model
    protected $items_tb = "items_tb";
    protected $table = "category_tb";
//=====================================================
 public function GetCategory()
   {
   	  $data = DB::table($this->table)->where('deleted', 'false')->orderBy('id', 'desc')->get();
      return $data;
   }
public function GetCategoryName($id)
{
  $data = DB::table($this->table)->where([['id','=', $id]])->orderBy('id', 'desc')->get();
  return $data;
}
public function GetMenuCategory()
{
	$data = DB::table($this->table)->where('deleted', 'false')->orderBy('id', 'desc')->skip(0)->take(8)->get();
    return $data;
}
public function GetCategoryItems($id)
{
	$data = DB::table($this->items_tb)
   	   ->where([['deleted','=', 'false'],['status','=', 'published'],['category_id','=', $id]])
   	   ->orderBy('id', 'desc')
   	   ->skip(0)
   	   ->take(30)
   	   ->get();
        return $data;
}
}
?>
  