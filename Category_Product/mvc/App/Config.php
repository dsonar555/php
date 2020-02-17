<?php 

namespace App;
/**
 * App Configuration
 */

class Config {
    /**
     * Database host
     * @var string
     */
    const DB_HOST = "localhost";

    /**
     * Database Name
     * @var string
     */
    const DB_NAME = "product_portal";

    /**
     * Database User
     * @var string
     */
    const DB_USER = "root";

    /**
     * Database Password
     * @var string
     */
    const DB_PASSWORD = "";

    /**
     * Base Url
     * @var string
     */
    const BASE_URL = "http://localhost/mvc/public";

    /**
     * show or hide error messages on screen
     * @var boolean
     */
    const SHOW_ERRORS = true;

    /**
     * file upload path
     * @var string
     */
    const UPLOAD_PATH = 'C:/xampp/htdocs/mvc/public';
}

?>