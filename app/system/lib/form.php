<?php

/**
 * Date: 07/01/2019
 * Time: 21:00
 */
class Form
{
    private static $html;
    private static $_instance = null;

    public static function run()
    {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    public static function Start()
    {
        self::run();
        Form::$html = '<form ';
        return self::$_instance;
    }

    public static function Close()
    {
        Form::$html .= '</form> ';
        return self::$_instance;
    }

// =========== form attribute =================
    public static function method($method)
    {
        Form::$html .= 'method="' . $method . '" ';
        return self::$_instance;
    }

    public static function enctype()
    {
        Form::$html .= 'enctype="multipart/form-data" ';
        return self::$_instance;
    }

    public static function url($action)
    {
        Form::$html .= 'action="' . $action . '" >';
        return self::$_instance;
    }

    public static function class_($class)
    {
        Form::$html .= 'class="' . $class . ' " ';
        return self::$_instance;
    }

    public static function id($id)
    {
        Form::$html .= 'id="' . $id . ' " ';
        return self::$_instance;
    }

    public static function value($value)
    {
        Form::$html .= 'value="' . $value . '" ';
        return self::$_instance;
    }

    public static function placeholder($value)
    {
        Form::$html .= 'placeholder="' . $value . '" ';
        return self::$_instance;
    }

    public static function name($name)
    {
        Form::$html .= 'name="' . $name . '" >';
        return self::$_instance;
    }

    public static function option($values, $active_item)
    {
        $length = count($values) - 1;
        foreach ($values as $key => $value) {
            if ($active_item == $value[1]) {
                Form::$html .= '<option value="' . $value[1] . '" selected>' . $value[0] . '</option>';
            } else {
                Form::$html .= '<option value="' . $value[1] . '">' . $value[0] . '</option>';
            }
            if ($length == $key) {
                Form::$html .= "</select>";
            }

        }
        return self::$_instance;
    }

    public static function checked()
    {
        Form::$html .= "checked";
    }

    // ============== Form input ========================
    public static function Text()
    {
        self::run();
        Form::$html .= '<input type="text" ';
        return self::$_instance;
    }

    public static function Hidden()
    {
        self::run();
        Form::$html .= '<input type="hidden" ';
        return self::$_instance;
    }

    public static function Number()
    {
        self::run();
        Form::$html .= '<input type="number" ';
        return self::$_instance;
    }

    public static function Radio()
    {
        self::run();
        Form::$html .= '<input type="radio" ';
        return self::$_instance;
    }

    public static function Button()
    {
        self::run();
        Form::$html .= '<input type="submit" ';
        return self::$_instance;
    }

    public static function CheckBox()
    {
        self::run();
        Form::$html .= '<input type="checkbox" ';
        return self::$_instance;
    }

    public static function File()
    {
        self::run();
        Form::$html .= '<input type="file" ';
        return self::$_instance;
    }

    public static function Files()
    {
        self::run();
        Form::$html .= '<input type="file" multiple ';
        return self::$_instance;
    }

    public static function Date()
    {
        self::run();
        Form::$html .= '<input type="date" ';
        return self::$_instance;
    }

    public static function Select()
    {
        self::run();
        Form::$html .= '<select  ';
        return self::$_instance;
    }

    //========== form option ==================
    public static function Display()
    {
        echo Form::$html;
    }

    //========== form validation ================
    public static function IsEmail($email)
    {
        if (!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email)) {
            return false;
        } else {
            return $email;
        }
    }

    public static function IsDate($date)
    {
        if (strpos($date, '/') !== false) {
          $date_array =     list($year, $month, $day) = explode('/', $date);
        }elseif (strpos($date, '-') !== false){
            $date_array =   list($year, $month, $day) = explode('-', $date);
        }elseif (strpos($date, '/') !== false){
            $date_array =    list($year, $month, $day) = explode('.', $date);
        }else{
            return false;
        }
        if( count($date_array) == 3 ) {
            if (is_numeric($year) && is_numeric($month) && is_numeric($day)) {
                $patterns = array(
                    '/^(\d{4})[\-](0[1-9]|1[012])[\-](0[1-9]|[12][0-9]|3[01])/', //yyyy-mm-dd pattern
                    '/^(\d{4})[\/](0[1-9]|1[012])[\/](0[1-9]|[12][0-9]|3[01])/', //yyyy/mm/dd pattern
                    '/^(0[1-9]|[12][0-9]|3[01])[\-](0[1-9]|1[012])[\-](\d{4})$/', //dd-mm-yyyy pattern
                    '/^(0[1-9]|[12][0-9]|3[01])[\/](0[1-9]|1[012])[\/](\d{4})$/', //dd/mm/yyyy pattern
                );
                foreach ($patterns as $pattern)
                {
                    if (preg_match($pattern, $date))
                    {
                        return $date;
                    }
                }
            }else{
                return false;
            }
        }else{
            return false;
        }

        }

    public static function IsNumber($number)
    {
        if (is_numeric($number ) ){
            return $number;
        }else{
            return false;
        }
    }

    public static function IsText($text){
        if(preg_match("/^[a-zA-Z]+$/", $text)){
            print $text;
        }else{
            return false;
        }
    }

    public static function hasLength($text,$min,$max){
        if (strlen($text) >= $min && strlen($text) <= $max) {
            return true;
        }else{
            return false;
        }
    }
    public static function Data($json,$security){
        $data = json_decode($json);
        $db_data = array();
        $auth = null;
        foreach ($data as $item){
            $col = $item->name;
            $val = $item->value;
            if($col != 'auth') {
                $db_data[$col]  =  $val;
            }else{
                $auth =  $val ;
            }
        }
        $date = date('Y-m-d H:i:s');
        $db_data['created_date']  = $date;
        $db_data['updated_date']  = $date;
        $db_data['deleted']             = 'false';

        if($security){
        if( $auth == null ||  $auth != Session::init()->Get('auth-token') ){
           return  null;
        }else{
            return $db_data;
        }}
        else{
            return  $db_data;
        }

    }

    public static function UpdateData($json,$security){
        $data = json_decode($json);
        $db_data = array();
        $auth = null;
        foreach ($data as $item){
            $col = $item->name;
            $val = $item->value;
            if($col != 'auth') {
                $db_data[$col]  =  $val;
            }else{
                $auth =  $val ;
            }
        }
        $date = date('Y-m-d H:i:s');
        $db_data['updated_date']  = $date;

        if($security){
            if( $auth == null ||  $auth != Session::init()->Get('auth-token') ){
                return  null;
            }else{
                return $db_data;
            }}
        else{
            return  $db_data;
        }

    }



}

?>