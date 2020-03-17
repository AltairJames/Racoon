<?php

namespace Racoon\Core\Request\Handler;

use Racoon\Core\Facade\Cache;
use Racoon\Core\Request\Bundle;

abstract class HandlerBase {

    protected $index = 0;
    protected $cache;
    protected $handler;
    protected $default;
    protected $groups;
    protected $bundle;
    protected $length;

    /**
     * Extract cache data.
     */

    protected function extractCacheData(string $type) {
        $this->cache = Cache::config()->handler();
        $this->handler = $this->cache[$type];
        $this->default = $this->route->middleware ?? 'generic';
        $this->groups = $this->handler;
        $this->bundle = new Bundle($this->bundle);
    }

    /**
     * Start handler iteration.
     */

    protected function startIteration() {
        $handler = $this->groups['generic'];
        if($this->default !== 'generic') {
            $handler = array_merge($handler, $this->groups[$this->default]);   
        }
        $this->length = sizeof($handler);
        $index = $this->index;
        $this->execHandler($handler[$index]);
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