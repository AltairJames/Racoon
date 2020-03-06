<?php

namespace Racoon\Core\Request;

use Racoon\Core\Application;
use Racoon\Core\Facade\Cache;
use Racoon\Core\Facade\Request;

class RequestManager {

    private static $instance;
    private $context;
    private $success = false;
    private $route;

    private function __construct(Application $context) {
        $this->context = $context;
        $this->init();
    }

    /**
     * Start step by step process of request handling.
     */

    private function init() {
        $uri = Request::uri();
        $cached = Cache::route($uri);

        /**
         * If uri is still not cached, generate cache file.
         */
        
        if(is_null($cached)) {
            $cached = Cache::routes();


        }
        else {
            $this->route = $cached;
        }
    }

    /**
     * Return collection of route data.
     */

    public function getRouteData() {
        return $this->route;
    }

    /**
     * Return success status.
     */

    public function success() {
        return $this->success;
    }

    /**
     * Instantiate this service using singleton
     * pattern to prevent multiple instantiation.
     */

    public static function start(Application $context) {
        if(is_null(static::$instance)) {
            static::$instance = new self($context);
        }
        return static::$instance;
    }

}