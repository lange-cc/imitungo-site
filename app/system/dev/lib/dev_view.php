<?php
class dev_view{
    function __construct()
    {

    }
    public function render($path, $headerFooter = true){
        if($headerFooter == true) {
            require 'app/system/dev/view/pages/header.php';
            require 'app/system/dev/view/' . $path . '.php';
            require 'app/system/dev/view/pages/footer.php';
        }else{
            require 'app/system/dev/view/' . $path . '.php';
        }
    }
}
?>