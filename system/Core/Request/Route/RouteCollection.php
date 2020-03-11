<?php

namespace Racoon\Core\Request\Route;

use Racoon\Core\Facade\Route;

class RouteCollection {

    private $collection = [];

    public function __construct() {}

    /**
     * Add web route in route group.
     */

    public function web(string $uri, string $controller) {
        $route = Route::web($uri, $controller);
        $this->collection[] = $route;
        return $route;
    }

    /**
     * Add api route in route group.
     */

    public function api(string $uri, string $controller) {
        $route = Route::api($uri, $controller);
        $this->collection[] = $route;
        return $route;
    }

    /**
     * Return collection.
     */

    public function getCollection() {
        return $this->collection;
    }

}