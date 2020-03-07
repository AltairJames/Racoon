<?php

namespace Racoon\Core\Request\Route;

use Racoon\Core\Application;

class RouteFactory {

    /**
     * Register all routes in this static variable.
     */

    private static $routes = [];

    private $context;

    public function __construct(Application $context) {
        $this->context = $context;
    }

    /**
     * Routes mostly web pages.
     */

    public function web(string $uri, $argument) {
        $route = new WebRoute($this->context, $uri, $argument);
        static::$routes[] = $route;
        return $route;
    }

    /**
     * Routes that use 
     */

    public function api(string $uri, $argument) {
        $route = new APIRoute($this->context, $uri, $argument);
        static::$routes[] = $route;
        return $route;
    }

    /**
     * Return array of Route objects.
     */

    public static function getRouteList() {
        return static::$routes;
    }

}