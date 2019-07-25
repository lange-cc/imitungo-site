<?php
/**
 *
 */

class engine extends controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function getUrl()
    {
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $url = parse_url($actual_link);
        $path = $url['path'];
        $path = str_replace('-', '_', $path);
        if ($url['host'] == "localhost" || $url['host'] == "127.0.0.1") {
            $prefix = '/';
            if (substr($path, 0, strlen($prefix)) == $prefix) {
                $path = substr($path, strlen($prefix));
            }
        }
        $url = explode("/", $path);
        $new_url = "";
        foreach ($url as $key => $value) {
            $key = $key + 1;
            if ($key < count($url)) {
                $new_url .= $url[$key] . "/";
            }
        }

        if ($new_url == "/") {
            $this->validateUrl(SITE_START_PAGE);
        } else {
            $this->validateUrl($new_url);
        }
    }

    public function validateUrl($url)
    {
        $url = rtrim($url, '/');
        $url = explode('/', $url);
        define('URL', $url);
        if (defined('URL')) {
            if (URL[0] == API_FOLDER) {
                header('Access-Control-Allow-Origin: *');
                header("Access-Control-Allow-Headers: Content-type");
                header("Content-type: application/json");
            }
        }
        if ($url[0] == 'dev') {
            if (DEVELOPMENT == true) {
                require_once 'app/system/dev/index.php';
            } else {
                echo "YOU ARE NOT ALLOWED TO ENTER TO THIS DEVELOPMENT PAGE";
            }
            exit;
        } else {
            $this->loadsite($url);
        }
    }

    public function loadsite($url)
    {
        if (count($url) == 1) {
            //========= for admin ====================
            if ($url[0] == ADMIN_FOLDER) {
                if (count($url) == 2) {
                    //One way routing system
                    if (strpos($url[1], '_')) {
                        $controller_name = $url[1];
                        if (!file_exists(ADMIN_FOLDER . '/C/' . $controller_name . '_controller.php')) {
                            $new_url = trim($url[1], '_');
                            $new_url = explode('_', $new_url);
                            $this->attach_url($new_url);
                        } else {
                            $this->attach_url($url);
                        }
                    } else {
                        $this->attach_url($url);  //when not one way routing
                    }
                } else {
                    $this->attach_url($url);
                }
                //========= for api ====================
            } elseif ($url[0] == API_FOLDER) {
                if (count($url) == 2) {
                    //One way routing system
                    if (strpos($url[1], '_')) {
                        $controller_name = $url[1];
                        if (!file_exists(API_FOLDER . '/C/' . $controller_name . '_controller.php')) {
                            $new_url = trim($url[1], '_');
                            $new_url = explode('_', $new_url);
                            $this->attach_url($new_url);
                        } else {
                            $this->attach_url($url);
                        }
                    } else {
                        $this->attach_url($url);  //when not one way routing
                    }
                } else {
                    $this->attach_url($url);
                }

                //========= for site ====================
            } else {
                //One way routing system
                if (strpos($url[0], '_')) {
                    $controller_name = $url[0];
                    if (!file_exists(SITE_FOLDER . '/C/' . $controller_name . '_controller.php')) {
                        $new_url = trim($url[0], '_');
                        $new_url = explode('_', $new_url);
                        $this->attach_url($new_url);
                    } else {
                        $this->attach_url($url);
                    }
                } else {
                    $this->attach_url($url);  //when not one way routing
                }
            }
            //When is default routing
        } else {
            $this->attach_url($url);
        }

    }

    public function attach_url($url)
    {
        if (count($url) == 1) {
            $this->url_phase_one($url);
        } elseif (count($url) == 2) {
            $this->url_phase_two($url);
        } else {
            $this->url_phase_other($url);
        }
    }

    public function url_phase_one($url)
    {
//        Option to load Admin system
        if (ADMIN_FOLDER == $url[0]) {
            if (!isset($url[1])) {
                $controller_name = ADMIN_START_PAGE;
            } else {
                $controller_name = $url[1];
            }
            if (file_exists(ADMIN_FOLDER . '/C/' . $controller_name . '_controller.php')) {
                require ADMIN_FOLDER . '/C/' . $controller_name . '_controller.php';
                // Function to check if class exist
                if (class_exists($controller_name)) {
                    $controller = new $controller_name;
                    $this->model = $controller->StartUpModel($controller_name);
                    $method = method_exists($controller, "Autoload");
                    if ($method) {
                        $controller->Autoload($url);
                    } else {
                        $error = array(
                            'Type' => 'Function not found',
                            'Message' => "Function autoload is missing in " . $controller_name . " class   in [" . ADMIN_FOLDER . "/C/" . $controller_name . "_controller.php] file",
                            'Dir' => ADMIN_FOLDER . "/C/" . $controller_name . "_controller.php",
                            'Code' => '0003'
                        );
                        SYSTEM_ERROR::render_error($error);
                    }

                } else {
                    $error = array(
                        'Type' => 'Class not found',
                        'Message' => $controller_name . " class  not found in [" . ADMIN_FOLDER . "/C/" . $controller_name . "_controller.php] file",
                        'Dir' => ADMIN_FOLDER . "/C/" . $controller_name . "_controller.php",
                        'Code' => '0002'
                    );
                    SYSTEM_ERROR::render_error($error);
                }
            } else {
                if (DEVELOPMENT == true) {
                    $error = array(
                        'Type' => 'File missing',
                        'Message' => $controller_name . "_controller.php file not found in [" . ADMIN_FOLDER . "/C]",
                        'Dir' => ADMIN_FOLDER . "/C/",
                        'Code' => '0001'
                    );
                    SYSTEM_ERROR::render_error($error);
                } else {
                    $this->GetErrorPage($url, ADMIN_FOLDER, ADMIN_ERROR_PAGE);
                }
            }
//            ================================================================
//            Option to load Api system
        } elseif (API_FOLDER == $url[0]) {
            if (!isset($url[1])) {
                $controller_name = API_VERSION;
            } else {
                $controller_name = $url[1];
            }
            if (file_exists(API_FOLDER . '/C/' . $controller_name . '_controller.php')) {
                require API_FOLDER . '/C/' . $controller_name . '_controller.php';
                // Function to check if class exist
                if (class_exists($controller_name)) {
                    $controller = new $controller_name;
                    $this->model = $controller->StartUpModel($controller_name);
                    $method = method_exists($controller, "Autoload");
                    if ($method) {
                        $controller->Autoload($url);
                    } else {
                        $error = array(
                            'Type' => 'Function not found',
                            'Message' => "Function autoload is missing in " . $controller_name . " class   in [" . API_FOLDER . "/C/" . $controller_name . "_controller.php] file",
                            'Dir' => API_FOLDER . "/C/" . $controller_name . "_controller.php",
                            'Code' => '0003'
                        );
                        SYSTEM_ERROR::render_error($error);
                    }
                } else {
                    $error = array(
                        'Type' => 'Class not found',
                        'Message' => $controller_name . "  class  not found in [" . API_FOLDER . "/C/" . $controller_name . "_controller.php] file",
                        'Dir' => API_FOLDER . "/C/" . $controller_name . "_controller.php",
                        'Code' => '0002'
                    );
                    SYSTEM_ERROR::render_error($error);
                }
            } else {
                $error = array(
                    'Type' => 'File missing',
                    'Message' => $controller_name . "_controller.php file not found in [" . API_FOLDER . "/C]",
                    'Dir' => API_FOLDER . "/C/",
                    'Code' => '0001'
                );
                SYSTEM_ERROR::render_error($error);

            }
//                ==================================================================
//                Option to load site system
        } else {
            if (isset($url[0])) {
                $controller_name = $url[0];
            } else {
                $controller_name = SITE_START_PAGE;
            }
            if (file_exists(SITE_FOLDER . '/C/' . $controller_name . '_controller.php')) {
                require SITE_FOLDER . '/C/' . $controller_name . '_controller.php';
                // Function to check if class exist
                if (class_exists($controller_name)) {
                    $controller = new $controller_name;
                    $this->model = $controller->StartUpModel($controller_name);
                    $method = method_exists($controller, "Autoload");
                    if ($method) {
                        $controller->Autoload($url);
                    } else {
                        $error = array(
                            'Type' => 'Function not found',
                            'Message' => "Function autoload is missing in " . $controller_name . " class   in [" . SITE_FOLDER . "/C/" . $controller_name . "_controller.php] file",
                            'Dir' => SITE_FOLDER . "/C/" . $controller_name . "_controller.php",
                            'Code' => '0003'
                        );
                        SYSTEM_ERROR::render_error($error);
                    }
                } else {
                    $error = array(
                        'Type' => 'Class not found',
                        'Message' => $controller_name . " class  not found in [" . SITE_FOLDER . "/C/" . $controller_name . "_controller.php] file",
                        'Dir' => SITE_FOLDER . "/C/" . $controller_name . "_controller.php",
                        'Code' => '0002'
                    );
                    SYSTEM_ERROR::render_error($error);
                }
            } else {
                if (DEVELOPMENT) {
                    $error = array(
                        'Type' => 'File missing',
                        'Message' => $controller_name . "_controller.php file not found in [" . SITE_FOLDER . "/C]",
                        'Dir' => SITE_FOLDER . "/C/",
                        'Code' => '0001'
                    );
                    SYSTEM_ERROR::render_error($error);
                } else {
                    $this->GetErrorPage($url, SITE_FOLDER, SITE_ERROR_PAGE);
                }
            }
        }

    }

    public function url_phase_two($url)
    {
        //        Option to load Admin system
        if (ADMIN_FOLDER == $url[0]) {
            if (!isset($url[1])) {
                $controller_name = ADMIN_START_PAGE;
            } else {
                $controller_name = $url[1];
            }
            if (file_exists(ADMIN_FOLDER . '/C/' . $controller_name . '_controller.php')) {
                require ADMIN_FOLDER . '/C/' . $controller_name . '_controller.php';
                // Function to check if class exist
                if (class_exists($controller_name)) {
                    $controller = new $controller_name;
                    // Load modal for selected controller
                    $this->model = $controller->StartUpModel($controller_name);
                    //Checking if function exist
                    if (isset($url[2])) {
                        $method = method_exists($controller, $url[2]);
                        if ($method) {
                            $function = (string)$url[2];
                            $controller->$function($url);
                        } else {
                            $error = array(
                                'Type' => 'Function not found',
                                'Message' => "Function " . $url[2] . " is missing in " . $controller_name . " class   in [" . ADMIN_FOLDER . "/C/" . $controller_name . "_controller.php] file",
                                'Dir' => ADMIN_FOLDER . "/C/" . $controller_name . "_controller.php",
                                'Code' => '0003'
                            );
                            SYSTEM_ERROR::render_error($error);
                        }
                    } else {

                        //Uncomment if you want to use autoload function when function missing
                        $method = method_exists($controller, "Autoload");
                        if ($method) {
                            $controller->Autoload($url);
                        } else {
                            $error = array(
                                'Type' => 'Function not found',
                                'Message' => "Function autoload is missing in " . $controller_name . " class   in [" . ADMIN_FOLDER . "/C/" . $controller_name . "_controller.php] file",
                                'Dir' => ADMIN_FOLDER . "/C/" . $controller_name . "_controller.php",
                                'Code' => '0003'
                            );
                            SYSTEM_ERROR::render_error($error);
                        }
                    }
                } else {
                    $error = array(
                        'Type' => 'Class not found',
                        'Message' => $controller_name . " class  not found in [" . ADMIN_FOLDER . "/C/" . $controller_name . "_controller.php] file",
                        'Dir' => ADMIN_FOLDER . "/C/" . $controller_name . "_controller.php",
                        'Code' => '0002'
                    );
                    SYSTEM_ERROR::render_error($error);
                }
            } else {
                if (DEVELOPMENT == true) {
                    $error = array(
                        'Type' => 'File missing',
                        'Message' => $controller_name . "_controller.php file not found in [" . ADMIN_FOLDER . "/C]",
                        'Dir' => ADMIN_FOLDER . "/C/",
                        'Code' => '0001'
                    );
                    SYSTEM_ERROR::render_error($error);
                } else {
                    $this->GetErrorPage($url, ADMIN_FOLDER, ADMIN_ERROR_PAGE);
                }

            }
//            ================================================================
//            Option to load Api system
        } elseif (API_FOLDER == $url[0]) {
            if (!isset($url[1])) {
                $controller_name = API_VERSION;
            } else {
                $controller_name = $url[1];
            }
            if (file_exists(API_FOLDER . '/C/' . $controller_name . '_controller.php')) {
                require API_FOLDER . '/C/' . $controller_name . '_controller.php';
                // Function to check if class exist
                if (class_exists($controller_name)) {
                    $controller = new $controller_name;
                    $this->model = $controller->StartUpModel($controller_name);
                    if (isset($url[2])) {
                        $method = method_exists($controller, $url[2]);
                        if ($method) {
                            $function = (string)$url[2];
                            $controller->$function($url);
                        } else {
                            $error = array(
                                'Type' => 'Function not found',
                                'Message' => "Function " . $url[2] . " is missing in " . $controller_name . " class   in [" . API_FOLDER . "/C/" . $controller_name . "_controller.php] file",
                                'Dir' => API_FOLDER . "/C/" . $controller_name . "_controller.php",
                                'Code' => '0003'
                            );
                            SYSTEM_ERROR::render_error($error);
                        }
                    } else {

                        //Uncomment if you want to use autoload function when function missing
                        $method = method_exists($controller, "Autoload");
                        if ($method) {
                            $controller->Autoload($url);
                        } else {
                            $error = array(
                                'Type' => 'Function not found',
                                'Message' => "Function autoload is missing in " . $controller_name . " class   in [" . API_FOLDER . "/C/" . $controller_name . "_controller.php] file",
                                'Dir' => API_FOLDER . "/C/" . $controller_name . "_controller.php",
                                'Code' => '0003',
                            );
                            SYSTEM_ERROR::render_error($error);
                        }

                    }
                } else {
                    $error = array(
                        'Type' => 'Class not found',
                        'Message' => $controller_name . " class  not found in [" . API_FOLDER . "/C/" . $controller_name . "_controller.php] file",
                        'Dir' => API_FOLDER . "/C/" . $controller_name . "_controller.php",
                        'Code' => '0002'
                    );
                    SYSTEM_ERROR::render_error($error);
                }
            } else {
                $error = array(
                    'Type' => 'File missing',
                    'Message' => $controller_name . "_controller.php file not found in [" . API_FOLDER . "/C]",
                    'Dir' => API_FOLDER . "/C/",
                    'Code' => '0001'
                );
                SYSTEM_ERROR::render_error($error);
            }
//                ==================================================================
//                Option to load site system
        } else {
            if (!isset($url[0])) {
                $controller_name = SITE_START_PAGE;
            } else {
                $controller_name = $url[0];
            }
            if (file_exists(SITE_FOLDER . '/C/' . $controller_name . '_controller.php')) {
                require SITE_FOLDER . '/C/' . $controller_name . '_controller.php';
                // Function to check if class exist
                if (class_exists($controller_name)) {
                    $controller = new $controller_name;
                    $this->model = $controller->StartUpModel($controller_name);
                    $method = method_exists($controller, $url[1]);
                    if ($method) {
                        $function = (string)$url[1];
                        $controller->$function($url);
                    } else {
                        $error = array(
                            'Type' => 'Function not found',
                            'Message' => "Function " . $url[1] . " is missing in " . $controller_name . " class   in [" . SITE_FOLDER . "/C/" . $controller_name . "_controller.php] file",
                            'Dir' => SITE_FOLDER . "/C/" . $controller_name . "_controller.php",
                            'Code' => '0003'
                        );
                        SYSTEM_ERROR::render_error($error);

                    }
                } else {
                    $error = array(
                        'Type' => 'Class not found',
                        'Message' => $controller_name . " class  not found in [" . SITE_FOLDER . "/C/" . $controller_name . "_controller.php] file",
                        'Dir' => SITE_FOLDER . "/C/" . $controller_name . "_controller.php",
                        'Code' => '0002'
                    );
                    SYSTEM_ERROR::render_error($error);
                }
            } else {
                if (DEVELOPMENT) {
                    $error = array(
                        'Type' => 'File missing',
                        'Message' => $controller_name . "_controller.php file not found in [" . SITE_FOLDER . "/C]",
                        'Dir' => SITE_FOLDER . "/C/",
                        'Code' => '0001'
                    );
                    SYSTEM_ERROR::render_error($error);
                } else {
                    $this->GetErrorPage($url, SITE_FOLDER, SITE_ERROR_PAGE);
                }
            }
        }
    }

    public function url_phase_other($url)
    {
        //        Option to load Admin system
        if (ADMIN_FOLDER == $url[0]) {
            if (!isset($url[1])) {
                $controller_name = ADMIN_START_PAGE;
            } else {
                $controller_name = $url[1];
            }
            if (file_exists(ADMIN_FOLDER . '/C/' . $controller_name . '_controller.php')) {
                require ADMIN_FOLDER . '/C/' . $controller_name . '_controller.php';
                // Function to check if class exist
                if (class_exists($controller_name)) {
                    $controller = new $controller_name;
                    // Load modal for selected controller
                    $this->model = $controller->StartUpModel($controller_name);
                    //Checking if function exist
                    if (isset($url[2])) {
                        $method = method_exists($controller, $url[2]);
                        if ($method) {
                            $function = (string)$url[2];
                            $controller->$function($url);
                        } else {
                            $error = array(
                                'Type' => 'Function not found',
                                'Message' => "Function " . $url[2] . " is missing in " . $controller_name . " class   in [" . ADMIN_FOLDER . "/C/" . $controller_name . "_controller.php] file",
                                'Dir' => ADMIN_FOLDER . "/C/" . $controller_name . "_controller.php",
                                'Code' => '0003'
                            );
                            SYSTEM_ERROR::render_error($error);
                        }
                    } else {

                        //Uncomment if you want to use autoload function when function missing
                        $method = method_exists($controller, "Autoload");
                        if ($method) {
                            $controller->Autoload($url);
                        } else {
                            $error = array(
                                'Type' => 'Function not found',
                                'Message' => "Function autoload is missing in " . $controller_name . " class   in [" . ADMIN_FOLDER . "/C/" . $controller_name . "_controller.php] file",
                                'Dir' => ADMIN_FOLDER . "/C/" . $controller_name . "_controller.php",
                                'Code' => '0003'
                            );
                            SYSTEM_ERROR::render_error($error);
                        }
                    }
                } else {
                    $error = array(
                        'Type' => 'Class not found',
                        'Message' => $controller_name . " class  not found in [" . ADMIN_FOLDER . "/C/" . $controller_name . "_controller.php] file",
                        'Dir' => ADMIN_FOLDER . "/C/" . $controller_name . "_controller.php",
                        'Code' => '0002'
                    );
                    SYSTEM_ERROR::render_error($error);
                }
            } else {
                if (DEVELOPMENT == true) {
                    $error = array(
                        'Type' => 'File missing',
                        'Message' => $controller_name . "_controller.php file not found in [" . ADMIN_FOLDER . "/C]",
                        'Dir' => ADMIN_FOLDER . "/C/",
                        'Code' => '0001'
                    );
                    SYSTEM_ERROR::render_error($error);
                } else {
                    $this->GetErrorPage($url, ADMIN_FOLDER, ADMIN_ERROR_PAGE);
                }

            }
//            ================================================================
//            Option to load Api system
        } elseif (API_FOLDER == $url[0]) {
            if (!isset($url[1])) {
                $controller_name = API_VERSION;
            } else {
                $controller_name = $url[1];
            }
            if (file_exists(API_FOLDER . '/C/' . $controller_name . '_controller.php')) {
                require API_FOLDER . '/C/' . $controller_name . '_controller.php';
                // Function to check if class exist
                if (class_exists($controller_name)) {
                    $controller = new $controller_name;
                    $this->model = $controller->StartUpModel($controller_name);
                    if (isset($url[2])) {
                        $method = method_exists($controller, $url[2]);
                        if ($method) {
                            $function = (string)$url[2];
                            $controller->$function($url);
                        } else {
                            $error = array(
                                'Type' => 'Function not found',
                                'Message' => "Function " . $url[2] . " is missing in " . $controller_name . " class   in [" . API_FOLDER . "/C/" . $controller_name . "_controller.php] file",
                                'Dir' => API_FOLDER . "/C/" . $controller_name . "_controller.php",
                                'Code' => '0003'
                            );
                            SYSTEM_ERROR::render_error($error);
                        }
                    } else {

                        //Uncomment if you want to use autoload function when function missing
                        $method = method_exists($controller, "Autoload");
                        if ($method) {
                            $controller->Autoload($url);
                        } else {
                            $error = array(
                                'Type' => 'Function not found',
                                'Message' => "Function autoload is missing in " . $controller_name . " class   in [" . API_FOLDER . "/C/" . $controller_name . "_controller.php] file",
                                'Dir' => API_FOLDER . "/C/" . $controller_name . "_controller.php",
                                'Code' => '0003',
                            );
                            SYSTEM_ERROR::render_error($error);
                        }

                    }
                } else {
                    $error = array(
                        'Type' => 'Class not found',
                        'Message' => $controller_name . " class  not found in [" . API_FOLDER . "/C/" . $controller_name . "_controller.php] file",
                        'Dir' => API_FOLDER . "/C/" . $controller_name . "_controller.php",
                        'Code' => '0002'
                    );
                    SYSTEM_ERROR::render_error($error);
                }
            } else {
                $error = array(
                    'Type' => 'File missing',
                    'Message' => $controller_name . "_controller.php file not found in [" . API_FOLDER . "/C]",
                    'Dir' => API_FOLDER . "/C/",
                    'Code' => '0001'
                );
                SYSTEM_ERROR::render_error($error);
            }
//                ==================================================================
//                Option to load site system
        } else {
            if (!isset($url[0])) {
                $controller_name = SITE_START_PAGE;
            } else {
                $controller_name = $url[0];
            }
            if (file_exists(SITE_FOLDER . '/C/' . $controller_name . '_controller.php')) {
                require SITE_FOLDER . '/C/' . $controller_name . '_controller.php';
                // Function to check if class exist
                if (class_exists($controller_name)) {
                    $controller = new $controller_name;
                    $this->model = $controller->StartUpModel($controller_name);
                    $method = method_exists($controller, $url[1]);
                    if ($method) {
                        $function = (string)$url[1];
                        $controller->$function($url);
                    } else {
                        $error = array(
                            'Type' => 'Function not found',
                            'Message' => "Function " . $url[1] . " is missing in " . $controller_name . " class   in [" . SITE_FOLDER . "/C/" . $controller_name . "_controller.php] file",
                            'Dir' => SITE_FOLDER . "/C/" . $controller_name . "_controller.php",
                            'Code' => '0003'
                        );
                        SYSTEM_ERROR::render_error($error);

                    }
                } else {
                    $error = array(
                        'Type' => 'Class not found',
                        'Message' => $controller_name . " class  not found in [" . SITE_FOLDER . "/C/" . $controller_name . "_controller.php] file",
                        'Dir' => SITE_FOLDER . "/C/" . $controller_name . "_controller.php",
                        'Code' => '0002'
                    );
                    SYSTEM_ERROR::render_error($error);
                }
            } else {
                if (DEVELOPMENT) {
                    $error = array(
                        'Type' => 'File missing',
                        'Message' => $controller_name . "_controller.php file not found in [" . SITE_FOLDER . "/C]",
                        'Dir' => SITE_FOLDER . "/C/",
                        'Code' => '0001'
                    );
                    SYSTEM_ERROR::render_error($error);
                } else {
                    $this->GetErrorPage($url, SITE_FOLDER, SITE_ERROR_PAGE);
                }
            }
        }
    }
}
?>
