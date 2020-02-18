<?php

/** 
 * Front Controller
 * 
 * PHP Version 7.3
*/

/**
 * composer autoload
 */
require '../vendor/autoload.php';
session_start();
/**
 * Autoloader
 */
/* spl_autoload_register(function ($class) {
    $root = dirname(__DIR__);
    $file = $root.'/'.str_replace('\\','/',$class).'.php';
    if(is_readable($file))
    {
        require $root.'/'.str_replace('\\','/',$class).'.php';
    }
}); */

/**
 * Error and Exception handling
 */
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

/**
 * require the contoller class
 */

/**
 * Routing
 */

$router = new Core\Router();

/**
 * add routes to the routing table
 */
$router->add('',['controller'=>'Main','action'=>'view','urlkey'=>'home']);
$router->add('{urlkey}',['controller'=>'Main','action'=>'view']);
$router->add('admin/{action}',['namespace' => 'Admin','controller'=>'Admin']);

$router->add('{controller}/{action}/{id:\d+}');
$router->add('{controller}/{action}');
$router->add('admin/cms/{controller}/{action}',['namespace' => 'Admin\cms']);
$router->add('admin/cms/{controller}/{action}/{id:\d+}',['namespace' => 'Admin\cms']);
$router->add('admin/{controller}/{action}',['namespace' => 'Admin']);
$router->add('admin/{controller}/{action}/{id:\d+}',['namespace' => 'Admin']);
$router->add('{controller}/{action}/{urlkey}');

$router->dispatch($_SERVER['QUERY_STRING']);

?>