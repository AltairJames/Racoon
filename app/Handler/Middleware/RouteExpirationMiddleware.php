<?php

namespace App\Handler\Middleware;

use Racoon\Core\Application\Middleware;
use Racoon\Core\Request\Bundle;

class RouteExpirationMiddleware extends Middleware {

    protected function observe(Bundle $bundle) {

        

        return $this->next();
    }

    protected function log() {}

}