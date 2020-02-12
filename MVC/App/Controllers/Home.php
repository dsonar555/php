<?php

namespace App\Controllers;
use \Core\View;

class Home extends \Core\Controller {
    public function indexAction() {
        // echo 'in index of'.get_class($this);
        $data = ['name' => 'Divya',
        'colors' => ['Orange','Black','Grey','Blue'],
        'base_url'=> dirname($_SERVER['SCRIPT_NAME']) ];
        //View::render('Home/index.php',$data);
        View::templateRender('Home/index.html',$data);
    }

    protected function before() {
        //echo " (Before.) ";
    }
    protected function after() {
        //echo " (After.)";
    }
}

?>