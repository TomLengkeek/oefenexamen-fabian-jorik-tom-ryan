<?php
//core app class

class Core {
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->getURl();
        if (file_exists('../app/controllers/' .  ucwords($url[0]) . '.php')) {
            // will set a new controller
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
        }
        //Require the controller
        require_once '../app/controllers/' . $this-> currentController . '.php';
        $this->currentController = new $this->currentController;
         // check for second part of the URL
        if (isset($url[1])) {
            if (method_exists($this->currentController, $url[1])) {
                  $this->currentMethod = $url[1];
                  unset($url[1]);
            }
        }
        //Get parameters
        $this->params = $url ? array_values($url) : [];
        
        //call a callback with array params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }
    
    public function getURl() {
        if(isset($_GET['url'])) {
            
            $url = rtrim($_GET['url'], '/');
           //allows you to filter variables as string/number
            $url = filter_var($url, FILTER_SANITIZE_URL);
            //breaking it into an array
            $url = explode('/', $url);
            return $url;
        }
    } 
    

}