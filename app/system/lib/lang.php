<?php
class Lang extends model {
    private static $instance;
    private static $locale = null;
    function __construct()
    {
        if(LANGUAGE_STORAGE == 'file'){
            $this->CheckFile(DEFAULT_LANGUAGE);
        }elseif (LANGUAGE_STORAGE == 'database'){
            $this->IsTableExist();

        }
    }
    private function init(){
        self::$instance = new self();
        return  self::$instance ;
    }
    public function CheckFile($locale){
        if(!file_exists('app/language/locale/'.$locale.'/lang.php')){
            $error = array(
                'Type'         => 'File missing',
                'Message' => "<b>".$locale."</b> locale is missing or incorrect typing, Try to create this way in app/language/locale/".$locale."/lang.php or correct locale name.",
                'Dir'            => 'app/language/locale/'.$locale.'/',
                'Code'        => '0001'
            );
            SYSTEM_ERROR::render_error($error);
        }
    }
    public static function Trans($text){
        if(MULTI_LANGUAGE == true) {
        $locale = self::$locale;
        if(Cookies::Get('sys-lang') != null){
            $locale = Cookies::Get('sys-lang');
            if( self::$locale != null){
                $locale = self::$locale;
            }
        }else{
            $locale = DEFAULT_LANGUAGE;
        }

        if(LANGUAGE_STORAGE == 'file'){
            $keywords = null;
            if(!file_exists('app/language/locale/'.$locale.'/lang.php')){
                $error = array(
                    'Type'         => 'File missing',
                    'Message' => "<b>".$locale."</b> locale is missing or incorrect typing, Try to create this way in app/language/locale/".$locale."/lang.php or correct locale name.",
                    'Dir'            => 'app/language/locale/'.$locale.'/',
                    'Code'        => '0001'
                );
                SYSTEM_ERROR::render_error($error);
            }else{
                require_once 'app/language/locale/'.$locale.'/lang.php';
        }
            if (isset($keywords[$text])){
                   return $keywords[$text];
            }else{
                self::SaveKeyword( $keywords,$text);
                return $text;
            }
        }elseif (LANGUAGE_STORAGE == 'database'){
             $length =    DB::table("lang-keywords")->select('value')->where([['key','=',$text],['locale','=', $locale]])->count();
             if ($length > 0){
                  $data  = DB::table("lang-keywords")->select('value')->where([['key','=',$text],['locale','=', $locale]])->get();
                   return  $data[0]->value;
             }else{
                 self::SaveKeyword( null,$text);
             }

        }
    } else{

                $error = array(
                    'Type'         => 'Logical error',
                    'Message' => "It seems you  need translation option, MULTILANGUAGE not turned on, Turn it on in constant file to make translation of the site",
                    'Dir'            => 'app/config/constant.php',
                    'Code'        => '0004'
                );
                SYSTEM_ERROR::render_error($error);
        }

    }

    public static function SaveKeyword($keywords,$text)
    {
        if(LANGUAGE_AUTO_SAVE == true){
        if (LANGUAGE_STORAGE == 'file') {
            if (Cookies::Get('sys-lang') != null) {
                $locale = Cookies::Get('sys-lang');
                $keywords[$text] = "";
            } else {
                $locale = DEFAULT_LANGUAGE;
                $keywords[$text] = $text;
            }
            file_put_contents('app/language/locale/' . $locale . '/lang.php', '<?php
$keywords = ' . var_export($keywords, true) . '; 
?>');
        } elseif (LANGUAGE_STORAGE == 'database') {
                if (Cookies::Get('sys-lang') != null) {
                    $locale = Cookies::Get('sys-lang');
                    $key = $text;
                    $value = "";
                } else {
                    $locale = DEFAULT_LANGUAGE;
                    $key     = $text;
                    $value = $text;
                }

            DB::table('lang-keywords')->insert([
                'key' => $key,
                'value' => $value,
                 'locale' => $locale
            ]);

    }

    }}

    public function IsTableExist(){
        // Check and Creation of lang-keywords table
       if(DB::schema()->hasTable('lang-keywords') == false){
           DB::schema()->create('lang-keywords',function($table)
           {
               $table->increments('id');
               $table->string('key');
               $table->string('value');
               $table->string('locale');
           });
       }
        // Check and Creation of lang-index table
        if(DB::schema()->hasTable('lang-index') == false){
            DB::schema()->create('lang-index',function($table)
            {
                $table->increments('id');
                $table->string('lang_name');
                $table->string('locale');
            });
        }
    }
    public static function SetLocale($locale){
        self::$locale  = $locale;
        Cookies::Add('sys-lang',$locale,30);
    }
}

// Starting language initialization
if(MULTI_LANGUAGE == true) {
    new Lang();
}
?>