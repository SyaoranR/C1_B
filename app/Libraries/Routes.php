<?php

/*
 * Routes Class
 * Create the URLs, load controllers, 
 * methods and params
 * URL FORMAT - /controlador/metodo/parametros
 */

class Routes {

    // class atributes
    private $controller = 'Pages';
    private $method = 'index';
    private $params = [];

    public function __construct()
    {
        // $this->url();
        // var_dump($this->url());
        // var_dump($this);
        // if else
        // if url exists put the url function at $url var, 
        // else returns arr[0]
        $url = $this->url() ? $this->url() : [0];  
        /*
         * checks if controller exists
         * ucwords - Convert to upperCase first 
         * character of each word
         */
        if (file_exists('../app/Controllers/'.ucwords($url[0]).'.php')):
            // if exists, it sets as controller
            $this->controller = ucwords($url[0]);
            // unset - 'Destroy' a especific var
            unset($url[0]);
        endif;   

        require_once '../app/Controllers/'.$this->controller.'.php';
        // instancing the controller
        $this->controller = new $this->controller;

        // checks if method exists, second part of url
        if(isset($url[1])):
            // Checks if class' method exists
            if(method_exists($this->controller, $url[1])):
                $this->method = $url[1];
                unset($url[1]);
            endif;
        endif;

        // If exists, it returns a arr with the values 
        // else it returns an empty arr
        // array_values - Returns all arr values

        $this->params = $url ? array_values($url) : [];
        // Call a determined user function with a params array
        call_user_func_array(
            [$this->controller, $this->method], 
            $this->params
        );

    }

    // one way of returning a url in a an arr
    private function url() {
        // echo $_GET['url']; 'prints' the url that appears
        // this filter removes all ilegal characters of a url
        $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);   
        // verifies if url exists
        if(isset($url)):
            /*
             * trim - removes initial and final spaces of a str
             * rtrim - remove empty space  
             * (or other characters) at end of a str
             */ 
            $url = trim(rtrim($url, '/'));
            // explode - divides a str in strings, returns a arr
            $url = explode('/', $url);
            return $url;
        endif;
    }

}

/*
 * public function __construct()
 * {
 *      $this->url();
 *      var_dump($this->url());
 * }
 * 
 * 
 * private function url() {
 *      echo $_GET['url'];
 *      type anything after '/' to appear something
 * }
 *  
 */

?>