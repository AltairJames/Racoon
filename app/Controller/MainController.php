<?php

namespace App\Controller;

use Racoon\Core\Application\Controller;
use Racoon\Core\Request\Bundle;

class MainController extends Controller {

    protected function index(Bundle $bundle) {
        
        return 'Hello World';
    }

}