<?php

// Map URL [Controller,Method,Parameter]


class Core
{
    protected $thisController = 'pages';
    protected $thisMethod = 'index';
    protected $parameters = [];

    public function __construct()
    {
        $url = $this->getUrl();

        //Search Controller
        if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
            $this->thisController = ucwords($url[0]);

            //unset index
            unset($url[0]);
        }

        //require controller
        require_once '../app/controllers/' . $this->thisController . '.php';
        $this->thisController = new $this->thisController;

        //check method
        if (isset($url[1])) {
            if (method_exists($this->thisController, $url[1])) {
                $this->thisMethod = $url[1];
                //unser index
                unset($url[1]);
            }
        }
        
        // echo $this->thisMethod;

        // get Parameters
        $this->parameters = $url ? array_values($url) : [];

        // Call callback with parameters array
        call_user_func_array([$this->thisController,$this->thisMethod], $this->parameters );
    }

    public function getUrl()
    {
        // echo $_GET['url'];
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}
