<?php 

namespace App\Controller\Admin;

class User extends \Core\Controller
{
    protected function before() {

    }

    protected function after() {

    }

    public function indexAction() {
        echo 'in index of'.get_class($this);
    }
}

?>