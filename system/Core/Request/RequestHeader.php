<?php

namespace Racoon\Core\Request;

use Racoon\Core\Facade\App;
use Racoon\Core\Facade\Request;
use Racoon\Core\Utility\Collection;

class RequestHeader {

    private static $instance;
    private $message;
    private $response;
    
    private function __construct(int $code, Collection $route = null, $response, string $message = null) {
        $this->message = $message;
        $this->response = $response;
        $this->setHeader($code, $route);
    }

    /**
     * Set http headers.
     */

    private function setHeader(int $code, Collection $route = null) {
        $this->noCache();

        if(is_null($route)) {
            
            if(App::isAjax()) {
                $this->setContentType('application/json');
            }
            else {
                $this->setContentType('text/html');
            }

            $method = Request::method();
            $this->setAllowedRequestMethod([$method]);
        }
        else {
            
            if($route->expire ?? false) {
                $this->setExpiration($route->expire);
            }

            if($route->allowAllOrigin ?? false) {
                $this->allowAllCrossOriginRequest();
            }

            $this->setContentType($route->dataType);
            $this->setAllowedRequestMethod($route->verb);
        }

        $this->setContentLength();
        $this->setHttpStatus($code);
    }

    /**
     * Prevent browser caching by setting expires to past date.
     */

    private function noCache() {
        header("Cache-Control: no-cache");
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
    }

    /**
     * Set expiration header.
     */

    private function setExpiration($expire) {

    }

    /**
     * Allow all request from cross origin.
     */

    private function allowAllCrossOriginRequest() {
        header("Access-Control-Allow-Origin: *");
    }

    /**
     * Set response content type.
     */

    private function setContentType(string $type) {
        header('Content-Type: ' . $type);
    }

    /**
     * Set content length header.
     */

    private function setContentLength() {
        header('Content-Length: ' . strlen(strval($this->response)));
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
        http_response_code($code);
        header(Request::protocol() . ' ' . $code . ' ' . $this->message);
    }

    /**
     * Use singleton pattern to instantiate
     * this class to prevent multiple instantiation.
     */

    public static function set(int $code, Collection $route = null, $response, string $message = null) {
        if(is_null(static::$instance)) {
            static::$instance = new self($code, $route, $response, $message);
        }
        return static::$instance;
    }

}