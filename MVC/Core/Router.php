<?php
/** 
 * Router
 * 
 * */ 
namespace Core;

class Router {
    /**
     * Associative array of routes (the routing table)
     * @var array
     */
    protected $routes = [];

    /**
     * Function to add route into routing table 
     * 
     * @param string $route the route URL
     * @param string $params Parameters (Controlle, actions, etc.)
     * 
     * returns void
     */
    public function add($route, $params = []) {
        // $this->routes[$route] = $params;

        /**
         * Convert the $route to a regular expression: escape forward slashes
         */
        $route = preg_replace('/\//','\\/',$route);
        // echo htmlspecialchars($route);
        /**
         * Convert variables e.g. {controller}
         */                                                  //(?P<\1>[a-z-]+)
        $route = preg_replace('/\{([a-z]+)\}/','(?P<\1>[a-z-]+)',$route);
        // echo htmlspecialchars($route);
        /**
         * Convert variables with custom regular expression e.g.{id:\d+}
         */
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/','(?P<\1>\2)',$route);
        // echo htmlspecialchars($route);
        
        //Add start and end delimiters , and case insensitive flag
        $route = '/^'.$route.'$/i';
        // echo '<br>'.htmlspecialchars($route);
        $this->routes[$route] = $params;
    }
//'{contoller}/{action}'
    /**
     * function to get all routes
     * returns array
     */

    public function getRoutes() {
        return $this->routes;
    }

    /**
     * Match the route to the routes in the routing table setting the $params Property if route is found 
     * 
     * @param string $url The route URL
     * @returns true if match is found, false otherwisw
     */

    public function match($url) {
        /* foreach($this->routes as $route => $params)
        {
            if($route == $url)
            {
                $this->params = $params;
                return true;
            }
        }
        return false; */

        /**
         * Match to the fixed URL format controller/actions
         */
        // $regex = "/^(?P<controller>[a-z-_]+)\/(?P<action>[a-z-_]+)$/";
        foreach($this->routes as $route => $params) {
            if(preg_match($route,$url,$matches)) {
                //Get named captured group values
                //$params = [];
                foreach($matches as $key => $value) {
                    if(is_string($key)) {
                        $params[$key] = $value;
                    }
                }
                $this->params = $params;
                return true;
            }
        }
        return false;
        
    }

    /**
     * Get the currently matched parameters
     * 
     * @return array
     */

    public function getParams() {
        return $this->params;
    }
    public function dispatch($url) {
        $url = $this->removeQueryStringVariables($url);
        if($this->match($url)) {
            $controller = $this->params['controller'];
            // echo $controller;
            $controller = $this->convertToStudlyCaps($controller);
            $controller = $this->getNamespace().$controller;
            
            if(class_exists($controller)) {
                $obj = new $controller($this->params);
                $action = $this->params['action'];
                $action = $this->convertToCamelCase($action);
                
                if(is_callable([$obj, $action])) {
                    // call_user_func_array([$obj,])
                    $obj->$action();
                } else {
                    echo "Method $action not found.";
                }
            } else {
                echo "Controller class $controller not found.";
            }
        } else {
            echo "No route matched";
        }
    }
    function convertToStudlyCaps($string) {
        return str_replace(' ', '', ucwords(str_replace('-',' ',$string))); 
    }
    function convertToCamelCase($string) {
        return lcfirst($this->convertToStudlyCaps($string));
    }

    function removeQueryStringVariables($url)
    {
        if($url != '') {
            $parts = explode('&',$url,2);
            // print_r($parts);
            if(strpos($parts[0],'=') === FALSE ) {
                $url = $parts[0];
            } else {
                $url = '';
            }
        }
        return $url;        
    }

    protected function getNamespace()
    {
        $namespace = 'App\Controllers\\';
        if(array_key_exists('namespace', $this->params)) {
            $namespace .= $this->params['namespace'].'\\';
        }
        return $namespace;
    }
}

?>