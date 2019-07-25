<?php
/**
 *
 */

class dev_engine extends dev_controller
{
    function __construct()
    {
        parent::__construct();
        $this->getUrl();
    }

    public function getUrl()
    {
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $url = parse_url($actual_link);
        $path = $url['path'];
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
        $this->validateUrl($new_url);

    }

    public function validateUrl($url)
    {
        $url = rtrim($url, '/');
        $url = explode('/', $url);
        $this->loadsite($url);
    }

    public function loadsite($url)
    {
        if (count($url) <= 2) {
            $this->url_phase_one($url);
        } else {
            $this->url_phase_two($url);
        }
    }

    public function url_phase_one($url)
    {

        if (!isset($url[1])) {
            $controller_name = "create";
        } else {
            $controller_name = $url[1];
        }
        if (file_exists('app/system/dev/controller/' . $controller_name . '_controller.php')) {
            require 'app/system/dev/controller/'  . $controller_name . '_controller.php';
            // Function to check if class exist
            if (class_exists($controller_name)) {
                $controller = new $controller_name;
                $method = method_exists($controller, "Autoload");
                if ($method) {
                    $controller->Autoload($url);
                }
            }
        }
    }

    public function url_phase_two($url)
    {
        if (!isset($url[1])) {
            $controller_name = 'home';
        } else {
            $controller_name = $url[1];
        }
        if (file_exists('app/system/dev/controller/'  . $controller_name . '_controller.php')) {
            require  'app/system/dev/controller/' . $controller_name . '_controller.php';
            // Function to check if class exist
            if (class_exists($controller_name)) {
                $controller = new $controller_name;
                // Load modal for selected controller
                $method = method_exists($controller, $url[2]);
                if ($method) {
                    $function = (string)$url[2];
                    $controller->$function($url);
                } else {
                    $method = method_exists($controller, "Autoload");
                    if ($method) {
                        $controller->Autoload($url);
                    }
                }
            }
        }
    }


}

?>
