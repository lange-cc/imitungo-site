<?php
class item_model extends model{
    // Table name to be used in this model
    protected $items_tb = "items_tb";
     protected $clients_tb = "clients_tb";
//=====================================================


   public function GetOffersData()
   {

   	if ( DB::table($this->items_tb)->where([['deleted','=', 'false'],['status','=', 'published'],['creator','=', 'client']])->count() > 0 ) {
   	 $data = DB::table($this->items_tb)
   	   ->where([['deleted','=', 'false'],['status','=', 'published'],['creator','=', 'client']])
   	   ->orderBy('id', 'desc')
   	   ->skip(0)
   	   ->take(30)
   	   ->get();
        return $data;
    }else{
    	$data = DB::table($this->items_tb)
   	   ->where([['deleted','=', 'false'],['status','=', 'published']])
   	   ->orderBy('id', 'asc')
   	   ->skip(0)
   	   ->take(30)
   	   ->get();
        return $data;
    }
   }

   public function GetItem($id)
   {
   	    $data = DB::table($this->items_tb)
   	   ->where([['deleted','=', 'false'],['status','=', 'published'],['id','=', $id]])
   	   ->orderBy('id', 'asc')
   	   ->skip(0)
   	   ->take(30)
   	   ->get();
        return $data;
   }

   public function relatedItems($id)
   {
   	   $data = DB::table($this->items_tb)
   	   ->where([['deleted','=', 'false'],['status','=', 'published'],['category_id','=', $id]])
   	   ->orderBy('id', 'asc')
   	   ->skip(0)
   	   ->take(30)
   	   ->get();
        return $data;
   }

   public function AddUserData($data)
   {
   	   $save = DB::table($this->clients_tb)->insert($data);
        if ($save) {
            return true;
        } else {
            return false;
        }
   }


}
?>
  