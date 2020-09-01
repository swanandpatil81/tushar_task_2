<?php
spl_autoload_register('eximpo_autoloader');

function eximpo_autoloader ($class)
{
    $class_file_path = APPPATH . 'controllers/' . $class . '.php';
    if (file_exists($class_file_path) && is_file($class_file_path)) {
        @include_once (APPPATH . 'controllers/' . $class . '.php');
    }
    else
    {
     $class_file_path = APPPATH . 'utilities/' . $class . '.php';
     if (file_exists($class_file_path) && is_file($class_file_path)) {
            require_once (APPPATH . 'utilities/' . $class . '.php');
        }
    }
}
?>