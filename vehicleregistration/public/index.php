<?php 
/** 
 * Front Controller
 * 
 * PHP Version 7.3
*/
session_start();
/**
 * composer autoload
 */
require '../vendor/autoload.php';

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
$router->add('',['controller'=>'Users','action'=>'login']);
$router->add('{controller}/{action}/{id:\d+}');
$router->add('{controller}/{action}');
$router->add('admin/{controller}/{action}',['namespace' => 'Admin']);
$router->add('admin/{controller}/{action}/{id:\d+}',['namespace' => 'Admin']);

 
// /**
//  * Display the routing table
//  */
// echo "<pre>";
// // var_dump($router->getRoutes());
// echo htmlspecialchars(print_r($router->getRoutes(),true));
// echo "</pre>";

// /**
//  * Match the requested route
//  */
// $url = $_SERVER['QUERY_STRING'];
// if($router->match($url)) {
//     echo '<pre>';
//     var_dump($router->getParams());
//     echo '</pre>';
// } 
// else {
//     echo "No route found for the requested URL '$url'";
// }

$router->dispatch($_SERVER['QUERY_STRING']);

?>