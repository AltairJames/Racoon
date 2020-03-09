<?php

namespace Racoon\Core\Request\Handler;

use Racoon\Core\Facade\Cache;

abstract class HandlerBase {

    protected $index = 0;
    protected $cache;
    protected $middleware;
    protected $default;
    protected $groups;

    /**
     * Extract cache data.
     */

    protected function extractCacheData(string $type) {
        $this->cache = Cache::config()->handler();
        $this->middleware = $this->cache[$type];
        $this->default = $this->middleware['default'];
        $this->groups = $this->middleware['groups'];
    }

    /**
     * Start handler iteration.
     */

    protected function startIteration() {
        $middleware = $this->groups[$this->default];
        $index = $this->index;
        $this->execHandler($middleware[$index]);
    }

    /**
     * Execute handler.
     */

    protected function execHandler(string $handler) {
        $instance = $handler::set();
        
    }

}