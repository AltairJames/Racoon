<?php

namespace Racoon\Core\Request\Handler;

use Racoon\Core\Application;
use Racoon\Core\Utility\Collection;

class AfterwareService extends HandlerBase {

    protected static $instance;
    protected $context;
    protected $success = false;
    protected $response = 500;
    protected $redirect;
    protected $bundle;

    private function __construct(Application $context, Collection $route = null, Collection $resource = null, $response) {
        $this->context = $context;
        $this->bundle = [

            'route'         => $route,
            'resource'      => $resource,
            'response'      => $response,

        ];
        $this->extractCacheData('afterware');
        $this->startIteration();
    }

    /**
     * Return if afterware is success.
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

    public static function set(Application $context, Collection $collection = null, Collection $resource = null, $response) {
        if(is_null(static::$instance)) {
            static::$instance = new self($context, $collection, $resource, $response);
        }
        return static::$instance;
    }

}