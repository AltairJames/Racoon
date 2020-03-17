<?php

namespace App\Handler\Middleware;

use Racoon\Core\Application\Middleware;
use Racoon\Core\Facade\Request;
use Racoon\Core\Request\Bundle;

class CrossOriginRequestMiddleware extends Middleware {

    protected function observe(Bundle $bundle) {
        
        if(!Request::isLocalhost()) {
            
        }

        return $this->next();
    }

    protected function log() {}

}