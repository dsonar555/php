<?php

namespace App\Controllers\Admin;
use Models\Admin as AdminModel;
use \Core\View;
use App\Config;

class Admin extends \Core\Controller {
    public function dashboard() {
        $services = AdminModel::getAll();
        View::
    }
}

?>