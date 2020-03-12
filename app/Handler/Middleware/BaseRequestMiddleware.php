<?php

namespace App\Handler\Middleware;

use Racoon\Core\Application\Middleware;
use Racoon\Core\Facade\App;
use Racoon\Core\Request\Bundle;

class BaseRequestMiddleware extends Middleware {

    protected function observe(Bundle $bundle) {
    App::locale($bundle->route('locale'));
        
        if(App::mode() === 'up' && $bundle->route('mode') === 'up') {
            return $this->next();
        }

        return $this->response(503);
    }

    protected function log() {
        
    }

}