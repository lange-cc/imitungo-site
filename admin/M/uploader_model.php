<?php

class uploader_model extends model{
    // Table name to be used in this model
    protected $table = 'files';
//=====================================================
public function SaveToDb( $name, $size, $ext,$v_name ,$date){
    if( DB::table($this->table)->insert(
        [
            'file_name'         => $name,
            'ext'                    => $ext,
            'size'                  => $size,
            'virtual_name'   => $v_name,
            'created_date'  => $date,
            'deleted'           => 'false'
        ])
    ) { return true;}
}
public function GetAllFiles(){
    return DB::table($this->table)->where([['deleted','=','false']])->orderBy('id', 'desc')->get();
}
public function DeleteFile($id){
    if(DB::table($this->table)->where([['id','=',$id]])->update([ 'deleted' => 'true'] )){
        return true;
    };
}
public function SearchFile($keyword){
    return DB::table($this->table)
        ->Where( [['file_name', 'like', '%'.$keyword.'%'],['deleted', '=', "false"]])
        ->orWhere( [['title', 'like', '%'.$keyword.'%'],['deleted', '=', "false"]])
        ->orWhere( [['descr', 'like', '%'.$keyword.'%'],['deleted', '=', "false"]])
        ->orWhere( [['ext', 'like', '%'.$keyword.'%'],['deleted', '=', "false"]])
        ->orWhere( [['keyword', 'like', '%'.$keyword.'%'],['deleted', '=', "false"]])
        ->orderBy('id', 'desc')
        ->get();
}
public function SearchFileByType($data){
       $files = array();
       foreach ($data as $item){
            $items =  DB::table($this->table)->Where( [['ext', '=',  $item],['deleted', '=', "false"]])->get();
            foreach ($items as $file){
                array_push($files,$file);
            }
       }
     return json_encode($files);
}
}
?>