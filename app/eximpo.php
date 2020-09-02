<?php 

require_once "autoload_classes.php";
require LIBPATH.'vendor/autoload.php';
session_start();
$request_uri_array = explode('/',$_SERVER['REQUEST_URI']);
array_shift($request_uri_array);
array_shift($request_uri_array);

$route_controller = "home";
$route_method = "index";

if(isset($request_uri_array[0]) && $request_uri_array[0]!='')
    $route_controller = $request_uri_array[0];
if(isset($request_uri_array[1]) && $request_uri_array[1]!='')
    $route_method = $request_uri_array[1];


$eximpo = new $route_controller();
if(method_exists($eximpo, 'setNotify')){
    
    $eximpo->setNotify(new activity());
}

$eximpo->$route_method();








?>