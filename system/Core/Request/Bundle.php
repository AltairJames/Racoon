<?php

namespace Racoon\Core\Request;

use Racoon\Core\Facade\Request;
use Racoon\Core\Utility\Collection;

class Bundle {

    private $route;
    private $resource;

    public function __construct(Collection $route, Collection $resource) {
        $this->route = $route;
        $this->resource = $resource;
    }

    /**
     * Return route data in collection format or
     * return data property.
     */

    public function route(string $id = null) {
        if(!is_null($id)) {
            return $this->route->{$id} ?? null;
        }
        else {
            return $this->route;
        }
    }

    /**
     * Return URI parameter.
     */

    public function param(string $name) {
        if(!is_null($this->resource)) {
            return $this->resource->{$name} ?? null; 
        }
    }

    /**
     * Return GET query parameter.
     */

    public function get(string $name, $default = null) {
        return Request::get($name, $default);
    }

    /**
     * Return POST query parameter.
     */

    public function post(string $name, $default = null) {
        return Request::post($name, $default);
    }

}