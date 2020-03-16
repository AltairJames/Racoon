<?php

namespace App\Handler\Middleware;

use Racoon\Core\Application\Middleware;
use Racoon\Core\Facade\App;
use Racoon\Core\Request\Bundle;

class BaseRequestMiddleware extends Middleware {

    protected function observe(Bundle $bundle) {
        
        if(App::mode() === 'up' && $bundle->route->mode === 'up') {
            App::locale($bundle->route->locale);
            return $this->next();
        }

        return $this->response(503);
    }

    protected function log() {
        
    }

}