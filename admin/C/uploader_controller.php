<?php

class uploader extends controller
{
    function __construct(){
        parent::__construct();
        Session::init();
    }
    public function Autoload($args){}
    public function upload($args){
        $file = json_decode(json_encode(Upload::dir("/assets/default/files/")->param("file")->IsRandomName(true)->Start()));
        $name = $file->file[0]->realname;
        $size = $file->file[0]->size;
        $fileinfo = new SplFileInfo($name);
        $ext =  $fileinfo->getExtension();
        $v_name = $file->file[0]->name;
        $date = $this->Date();
        if($this->model->SaveToDb( $name, $size, $ext,$v_name,$date )){
            $proced = new \stdClass();
            $proced->status  = "success";
            $proced->message = "uploaded";
            $proced->data    =  $file;
            $myJSON = json_encode($proced);
            echo $myJSON;
        };
    }
    public function AllFiles($args){
        echo $this->model->GetAllFiles();
    }
    public function Search($args){
        $keyword = Request::input('keyworld');
        echo $this->model->SearchFile($keyword);
    }
    public function Delete($args){
           $id = Request::input('id');
           if($this->model->DeleteFile($id)){
               $proced = new \stdClass();
               $proced->status   = "success";
               $proced->message = "Moved to Trash";
               $myJSON = json_encode($proced);
               echo $myJSON;
           }
    }
    public function SearchByType(){
        $keywords = Request::input('keyworld');
       $data  = explode(',' ,$keywords);
        echo $this->model->SearchFileByType($data);
    }
}