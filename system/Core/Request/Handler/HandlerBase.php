<?php

namespace Racoon\Core\Request\Handler;

use Racoon\Core\Facade\Cache;
use Racoon\Core\Request\Bundle;

abstract class HandlerBase {

    protected $index = 0;
    protected $cache;
    protected $middleware;
    protected $default;
    protected $groups;
    protected $bundle;
    protected $length;

    /**
     * Extract cache data.
     */

    protected function extractCacheData(string $type) {
        $this->cache = Cache::config()->handler();
        $this->middleware = $this->cache[$type];
        $this->default = $this->middleware['default'];
        $this->groups = $this->middleware['groups'];
        $this->bundle = new Bundle($this->route, $this->resource);
    }

    /**
     * Start handler iteration.
     */

    protected function startIteration() {
        $middleware = $this->groups[$this->default];
        $this->length = sizeof($middleware);
        $index = $this->index;
        $this->execHandler($middleware[$index]);
    }

    /**
     * Execute handler.
     */

    protected function execHandler(string $handler) {
        $instance = new $handler();
        $instance->set($this->bundle);
        $code = $instance->getStatus();

        if($instance->success()) {
            if(($this->index + 1) === $this->length) {
                $this->success = true;
            }
            else {
                $this->index++;
                $this->startIteration();
            }
        }
        else {
            $this->success = false;
            $this->response = $code;

            if($code === 307) {
                $this->redirect = $instance->getRedirectionURI();
            }
        }
    }

}