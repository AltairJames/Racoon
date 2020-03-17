<?php

namespace App\Handler\Middleware;

use Racoon\Core\Application\Middleware;
use Racoon\Core\Facade\Request;
use Racoon\Core\Request\Bundle;

class UseragentMiddleware extends Middleware {

    protected function observe(Bundle $bundle) {

        if(!Request::isLocalhost()) {
            if($bundle->emit->mobile && Request::isMobile()) {
                return $this->response(403);
            }
        }

        return $this->next();
    }

    protected function log() {}

}