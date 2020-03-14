<?php

namespace Racoon\Core\Request\Route;

abstract class RouteBase {

    protected $dataTypes = [
        'text'      => 'text/plain',
        'html'      => 'text/html',
        'json'      => 'application/json', 
        'xml'       => 'applciation/xml',
    ];

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

        'verb'              => [],

        'redirect'          => null,

        'auth'              => false,

        'mode'              => 'up',

        'auth'              => false,

        'cors'              => false,

        'expire'            => null,

        'maxRequest'        => null,

        'dataType'          => null,

        'https'             => false,

        'locale'            => 'en',

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
     * Set route status to down.
     */

    public function down() {
        $this->data['mode'] = 'down';
        return $this;
    }

    /**
     * Require authentication to routes.
     */

    public function requireAuthentication(bool $auth) {
        $this->data['auth'] = $auth;
        return $this;
    }

    /**
     * Allow request from other websites.
     */

    public function allowCrossOriginRequest(bool $cors) {
        $this->data['cors'] = $cors;
        return $this;
    }

    /**
     * Set route expiration date.
     */

    public function setExpire($expire) {
        $this->data['expire'] = $expire;
        return $this;
    }

    /**
     * Set maximum request per minute.
     */

    public function setMaximumRequest(int $max) {
        $this->data['maxRequest'] = $max;
        return $this;
    }

    /**
     * Require request connection using https.
     */

    public function requireHttps(bool $https) {
        $this->data['https'] = $https;
        return $this;
    }

    /**
     * Set the localization to use in each route.
     */

    public function setLocale(string $lang) {
        $this->data['locale'] = $lang;
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
        $verbs = $this->data['verb'] ?? [];
        return !in_array($verb, $verbs) && in_array($verb, $this->allowed_verbs);
    }

    /**
     * Return array of Route data.
     */

    public function getArrayData() {
        return $this->data;
    }

    /**
     * Apply route data changes using array.
     */

    public function inject(array $data) {
        foreach($data as $key => $value) {
            if($this->testInjectedData($key, $this->data[$key])) {
                $this->data[$key] = $value;
            }
        }
    }

    /**
     * Check data type of injected data.
     */

    private function testInjectedData(string $key, $value) {
        if(in_array($key, ['middleware', 'expire', 'max-request'])) {
            if(is_null($value)) {
                return true;
            }
        }
        else if(in_array($key, ['auth', 'cors', 'https'])) {
            if(is_bool($value) && !$value) {
                return true;
            }
        }
        else if($key === 'mode' && $value === 'up') {
            return true;
        }
    }

}