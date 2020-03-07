<?php

namespace Racoon\Core\Request\Route;

abstract class RouteBase {

    /**
     * Allowed http verbs for route request.
     */

    protected $allowed_verbs = ['get', 'post', 'put', 'patch', 'delete'];

    protected $data = [

        'type'              => null,

        'uri'               => null,

        'controller'        => null,

        'middleware'        => null,

        'method'            => null,

        'closure'           => null,

        'verb'              => [],

        'redirect'          => null,

    ];

    /**
     * Set route middleware.
     */

    public function middleware(string $middleware) {
        $this->data['middleware'] = $middleware;
        return $this;
    }

    /**
     * Execute redirection after each request.
     */

    public function redirect(string $uri) {
        $this->data['redirect'] = $uri;
        return $this;
    }

    /**
     * Test if argument is controller or closure.
     */

    protected function setDefaultProps($argument) {
        $split = explode('@', $argument);
        $this->data['controller'] = $split[0];
        $this->data['method'] = $split[1];
    }

    /**
     * Test if verb to use already exist from the route data.
     */

    protected function testVerb(string $verb) {
        return !in_array($verb, $this->data['verb']) && in_array($verb, $this->allowed_verbs);
    }

    /**
     * Return array of Route data.
     */

    public function getArrayData() {
        return $this->data;
    }

}