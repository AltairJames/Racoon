<?php

namespace Racoon\Core\Request;

use Racoon\Core\Utility\Collection;

class RequestHeader {

    private static $instance;
    
    private function __construct(int $code, Collection $route = null, $response) {
        $this->setHeader($code, $route);
    }

    /**
     * Set http headers.
     */

    private function setHeader(int $code, Collection $route = null) {
        if(is_null($route)) {

        }
        else {
            $this->setContentType($route->dataType);
            $this->setAllowedRequestMethod($route->verb);
        }
        $this->setHttpStatus($code);
    }

    /**
     * Set response content type.
     */

    private function setContentType(string $type) {
        header('Content-Type: ' . $type);
    }

    /**
     * Set allowed request method.
     */

    private function setAllowedRequestMethod(array $verbs) {
        header('Access-Control-Allow-Methods: ' . strtoupper(implode(', ', $verbs)));
    }

    /**
     * Set HTTP status code.
     */

    private function setHttpStatus(int $code) {
        if($code !== 200) {

        }
    }

    /**
     * Use singleton pattern to instantiate
     * this class to prevent multiple instantiation.
     */

    public static function set(int $code, Collection $route = null, $response) {
        if(is_null(static::$instance)) {
            static::$instance = new self($code, $route, $response);
        }
        return static::$instance;
    }

}