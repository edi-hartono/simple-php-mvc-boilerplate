<?php 

class Init
{
    private $controller;
    private $method;
    private $params;
    private $file;

    public function __construct($controller, $method)
    {
        $this->controller   = ucwords($controller);
        $this->method       = $method;
        $this->file         = 'controllers/' . $controller . '.php';

        $request    = explode('.', $_SERVER['PHP_SELF']);
        $request    = explode('/', $request[1]);
        unset($request[0]);

        // make controller
        if(isset($request[1])) {
            $this->file = 'controllers/' . ucwords($request[1]) . '.php';
            if(file_exists($this->file)) {
                $this->controller   = ucwords($request[1]);
                unset($request[1]);
            } else {
                echo '<h1>404 - File not Found!</h1>';die;
            }
        }
        
        require_once($this->file);
        $this->controller  = new $this->controller;

        // make method
        if(isset($request[2])) {
            if(method_exists($this->controller, $request[2])) {
                $this->method   = $request[2];
                unset($request[2]);
            }
        }

        // make params
        if(isset($request)) {
            $this->params   = array_values($request);
        }

        call_user_func_array([$this->controller, $this->method], $this->params);

    }
}

new Init('home', 'index');