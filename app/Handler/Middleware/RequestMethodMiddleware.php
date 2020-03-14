<?php

namespace App\Handler\Middleware;

use Racoon\Core\Application\Middleware;
use Racoon\Core\Facade\Request;
use Racoon\Core\Request\Bundle;

class RequestMethodMiddleware extends Middleware {

    protected function observe(Bundle $bundle) {
    $method = strtolower(Request::method());
    
        if($bundle->route->type === 'api') {
            if(in_array($method, $bundle->route->verb)) {
                return $this->next();
            }
        }
        else {
            if($method === 'get') {
                return $this->next();
            }
        }

        return $this->response(405);
    }

    protected function log() {

    }

}