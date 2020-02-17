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
        /**
         * Match to the fixed URL format controller/actions
         */
        foreach($this->routes as $route => $params) {
            if(preg_match($route,$url,$matches)) {
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
            $controller = $this->convertToStudlyCaps($controller);
            $controller = $this->getNamespace().$controller;
            
            if(class_exists($controller)) {
                $obj = new $controller($this->params);
                $action = $this->params['action'];
                $action = $this->convertToCamelCase($action);
                
                if(is_callable([$obj, $action])) {
                    // call_user_func_array([$obj,])
                    if(isset($this->params['id'])) {
                        $obj->$action($this->params['id']);
                    } else if (isset($this->params['urlkey'])) {
                        $obj->$action($this->params['urlkey']);
                    } else {
                        $obj->$action();
                    }
                } else {
                    throw new \Exception("Method $action (in $controller controller) not found");
                }
            } else {
                throw new \Exception("$controller controller not found");
            }
        } else {
            throw new \Exception("No route matched",404);
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