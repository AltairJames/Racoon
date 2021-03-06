<?php

namespace Racoon\Core\Request\Handler;

use Racoon\Core\Application;
use Racoon\Core\Utility\Collection;

class MiddlewareService extends HandlerBase {

    protected static $instance;
    protected $context;
    protected $success = false;
    protected $response = 500;
    protected $redirect;
    protected $bundle;

    private function __construct(Application $context, Collection $route, Collection $resource) {
        $this->context = $context;
        $this->bundle = [

            'route'     => $route,
            'resource'  => $resource,

        ];
        $this->extractCacheData('middleware');
        $this->startIteration();
    }

    /**
     * Return if middleware is success.
     */

    public function success() {
        return $this->success;
    }

    /**
     * Return http status code.
     */

    public function getStatus() {
        return $this->response;
    }

    /**
     * Return redirection uri.
     */

    public function getRedirect() {
        return $this->redirect;
    }

    /**
     * Use singleton pattern to prevent multiple
     * instantiation of this service class.
     */

    public static function set(Application $context, Collection $collection, Collection $resource) {
        if(is_null(static::$instance)) {
            static::$instance = new self($context, $collection, $resource);
        }
        return static::$instance;
    }

}