<?php

namespace App\Handler\Middleware;

use Racoon\Core\Application\Middleware;
use Racoon\Core\Facade\Request;
use Racoon\Core\Request\Bundle;

class RequestProtocolMiddleware extends Middleware {

    protected function observe(Bundle $bundle) {
    
        if(!Request::isLocalhost()) {
            if($bundle->route->https && !Request::isHttps()) {
                return $this->response(500);
            }
        }

        return $this->next();
    }

    protected function log() {}

}