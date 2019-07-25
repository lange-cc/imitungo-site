<?php
// Convert all text to upper case
function AllCharUpper($text){
    return strtoupper($text);
}

//Convert all text to lower case
function AllCharLower($text){
    return strtolower($text);
}

//Convert first character to upper case
function FirstCharUpper($text){
    return ucfirst($text);
}

//Convert first character to lower case
function FirstCharLower($text){
    return lcfirst($text);
}

//Convert each first character on word of sentence  to upper case
function FirstWordsCharUpper($text){
    return ucwords($text);
}

//Cut text
function CutText($data,$length,$more_icon = "..."){
    $string = strip_tags(htmlspecialchars_decode($data, ENT_NOQUOTES));
    if (strlen($string) > $length) {
        $string = substr($string, 0, $length).$more_icon;
    }
    return $string;
}

//Check if variable exist
function IsDefined($variable){
    if(isset($variable)){
        return $variable;
    }else{
        return null;
    }
}

//Check if variable exist
function IsEmpty($variable){
    if(!empty($variable)){
        return $variable;
    }else{
        return null;
    }
}

// Check page
function IsCurrentPage($data,$return){
        $page = URL[1];
        if ($page == $data) {
            return $return;
        }else{
            return false;
        }
}
// Check page
function IsTrue($data,$check,$return){
    if ($check == $data) {
        return $return;
    }else{
        return false;
    }
}



?>