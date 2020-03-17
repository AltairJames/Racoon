<?php

namespace App\Handler\Middleware;

use Racoon\Core\Application\Middleware;
use Racoon\Core\Facade\Cache;
use Racoon\Core\Facade\Request;
use Racoon\Core\Request\Bundle;

class IPBlockerMiddleware extends Middleware {

    protected function observe(Bundle $bundle) {
        $cache = Cache::config()->security();
        
        if(!Request::isLocalhost()) {
            if(in_array(Request::clientIP(), $cache['ip-blocker'])) {
                return $this->response(403);
            }
            else {
                $block = $bundle->route->blockIP;
                if(!empty($block)) {
                    if(in_array(Request::clientIP(), $block)) {
                        return $this->response(403);
                    }
                }
            }
        }

        return $this->next();
    }

    protected function log() {}

}