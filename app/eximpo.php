<?php 

require_once "autoload_classes.php";
require LIBPATH.'vendor/autoload.php';
session_start();

class eximpo {

    private static $instance = null;
    protected $db;
    private function eximpo()
    {
        $this->loadDatabase();
    }
    public static function getInstance()
    {
        if (self::$instance == null)
        {
            self::$instance = new eximpo();
        }
    
        return self::$instance;
    }
    private function loadDatabase()
    {
        include APPPATH."config/database.php";
        $this->db = new database(new DbDriver_mysqli($database_host,$database_user,$database_password,$database_dbname,$database_port));

    }
    public function render()
    {
        $request_uri_array = explode('/',$_SERVER['REQUEST_URI']);
        array_shift($request_uri_array);
        array_shift($request_uri_array);

        $route_controller = "home";
        $route_method = "index";

        if(isset($request_uri_array[0]) && $request_uri_array[0]!='')
            $route_controller = $request_uri_array[0];
        if(isset($request_uri_array[1]) && $request_uri_array[1]!='')
            $route_method = $request_uri_array[1];


        $controller = new $route_controller();
        if(method_exists($controller, 'setNotify')){
            
            $controller->setNotify(new activity());
        }

        $controller->$route_method();
    }
}

$eximpo = eximpo::getInstance();

$eximpo->render();


?>