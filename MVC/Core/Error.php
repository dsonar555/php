<?php

namespace Core;
/**
 * Error and exception handler
 */
class Error {

    /**
     * Error handler. Converts errors to exceptions by throwing an ErrorException.
     * 
     * @param int $level Error level
     * @param string $message Error message
     * @param string $file the filename the error was raised in
     * @param int $line the line number in file
     */
    public static function errorHandler($level, $message, $file, $line) {
        if(error_reporting() !==0) {
            throw new \ErrorException($message,0, $level, $file, $line);
        }
    }
    /**
     * Exception handler
     * @param Exception $exception  The exception.
     * @return void
     */
    public static function exceptionHandler($exception) {

        //Code is 404 (not found ) or 500 (general error)
        $code = $exception->getCode();
        if($code != 404) {
            $code = 500;
        }
        http_response_code($code);

        if(\App\Config::SHOW_ERRORS === true) {
            
            echo "<h1>Fatal Error</h1>";
            echo "<p>Uncaught exception : '".get_class($exception)."'</p>";
            echo "<p>Message : '". $exception->getMessage()."'</p>";
            echo "<p>Get Stack trace :<pre>'".$exception->getTraceAsString()."</pre>'<?p>";
            echo "<p>Trown in : '".$exception->getFile()."' on line '".$exception->getLine()."' <?p>";

        } else {
            
            $log = dirname(__DIR__) . '/logs/'.date('Y-m-d') . '.txt';
            ini_set('error_log',$log);
            $message = "Uncaught exception : '".get_class($exception)."'";
            $message .= "With Message : '". $exception->getMessage()."'";
            $message .= "\nGet Stack trace :'".$exception->getTraceAsString()."'";
            $message .= "\nTrown in : '".$exception->getFile()."' on line '".$exception->getLine()."'";
            $message .= "---------------------------------------------------------------------------------------------\n";

            error_log($message);
            // if($code == 404) {
            //     echo "<h2>Page not found.</h2>";
            // } else {
            //     echo "<h2>An error occured.</h2>";
            // }
            View::templateRender("$code.html");
        }

       
    }
}

?>