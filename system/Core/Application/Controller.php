<?php

namespace Racoon\Core\Application;

use Racoon\Core\Request\Bundle;
use Racoon\Core\Utility\Collection;

abstract class Controller {

    private $response;

    /**
     * Check if method exist from the child class.
     */

    public function set(string $method, Collection $route = null, Collection $resource = null, array $emit = []) {
        if(method_exists($this, $method)) {
            $this->response = $this->{$method}(new Bundle([
                
                'route'         => $route,
                'resource'      => $resource,
                'emit'          => new Collection('Emitted Values', $emit), 
            
            ]));
        }
        return $this->response;
    }

}