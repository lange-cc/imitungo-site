<?php
/**
 * Date: 22/12/2018
 * Time: 13:40
 */
//Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'db_imitungo');
define('DB_PREFIX', 'tb');
define('DB_USER', 'root');
define('DB_PASS', '');

// Start controller constant
define('SITE_START_PAGE', 'home');
define('ADMIN_START_PAGE', 'login');
define('API_VERSION', 'v1');

//System setting
define('DEVELOPMENT', true); // true = development , false = production mode
define("ADMIN_ERROR_PAGE", "error");
define("SITE_ERROR_PAGE", "error");

// Directory constant
define('ADMIN_FOLDER', 'admin');
define('API_FOLDER', 'api');
define('SITE_FOLDER', 'site');

//==================================================
//Admin Css and Js Assets setting
define("FOR_ADMIN", true);
define("A_DISPLAY_ON", 'header'); // js location: footer or header
define("A_JQUERY", true);
define("A_BOOTSTRAP", false);
define("A_NIMATION", true);
define("A_VUE_JS", true);
define("A_TURBOLINK_JS", false);

//Website Css and Js Assets setting
define("FOR_WEBSITE", true);
define("DISPLAY_ON", 'footer'); // js location: footer or header
define("JQUERY", false);
define("BOOTSTRAP", false);
define("ANIMATION", true);
define("VUE_JS", true);
define("TURBOLINK_JS", false);
//==================================================

//Language Setting
define("MULTI_LANGUAGE", true); //true = on :::  false = off
define('LANGUAGE_LOCALE_CHANGEABLE', 'yes'); // 'no' or 'yes'   [if yes means you will change locale by session called ['lang' key ] in every any controller function. ///// ex: Session::init()->Add('lang','en-us') ]
define('LANGUAGE_STORAGE', 'file'); // 'database' or file
define('DEFAULT_LANGUAGE', 'fr-fr'); //Enter locale found in [app/language/locale] folder
define("LANGUAGE_AUTO_SAVE", false); //true = yex :::  false = no