<?php
/**
 * Date: 03/01/2019
 * Time: 10:52
 */

class model extends Illuminate\Database\Eloquent\Model{
    public function Date(){
        return  date('Y-m-d H:i:s');
    }
}

?>