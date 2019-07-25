<?php
class home_model extends model{
    // Table name to be used in this model
    protected $items_tb = "items_tb";
    protected $category_tb = "category_tb";
    protected $clients_tb = "clients_tb";

//=====================================================

   public function GetRecentlyData()
   {
   	   $data = DB::table($this->items_tb)
   	   ->where([['deleted','=', 'false'],['status','=', 'published']])
   	   ->orderBy('id', 'desc')
   	   ->skip(0)
   	   ->take(30)
   	   ->get();
        return $data;
   }

  
   public function GetPopularData()
   {
   	    $data = DB::table($this->items_tb)
   	   ->where([['deleted','=', 'false'],['status','=', 'published']])
   	   ->orderBy('id', 'asc')
   	   ->skip(0)
   	   ->take(30)
   	   ->get();
        return $data;
   }

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

   public function GetSearchData($keyword)
   {
   	    return DB::table($this->items_tb)
        ->Where( [['name', 'like', '%'.$keyword.'%'],['deleted', '=', "false"],['status', '=', "published"]])
        ->orWhere( [['location', 'like', '%'.$keyword.'%'],['deleted', '=', "false"]])
        ->orWhere( [['model', 'like', '%'.$keyword.'%'],['deleted', '=', "false"]])
        ->orWhere( [['price', 'like', '%'.$keyword.'%'],['deleted', '=', "false"]])
        ->orWhere( [['year', 'like', '%'.$keyword.'%'],['deleted', '=', "false"]])
        ->orWhere( [['plate_number', 'like', '%'.$keyword.'%'],['deleted', '=', "false"]])
        ->orderBy('id', 'desc')
        ->get();
   }


    public function AddProductData($data)
   {
   	  $id = DB::table($this->items_tb)->insertGetId($data);
        if ($id) {
            return $id;
        } else {
            return 0;
        }
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

   public function GetSliderContent()
   {
       $data = DB::table('articles_tb')->where('deleted','false')->get();
       return $data;
    
   }

}
?>
  