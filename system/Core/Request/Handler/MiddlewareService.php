<?php

namespace Racoon\Core\Request\Handler;

use Racoon\Core\Application;
use Racoon\Core\Utility\Collection;

class MiddlewareService extends HandlerBase {

    protected static $instance;
    protected $context;
    protected $collection;
    private $success = false;

    private function __construct(Application $context, Collection $collection) {
        $this->context = $context;
        $this->collection = $collection;
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
     * Use singleton pattern to prevent multiple
     * instantiation of this service class.
     */

    public static function set(Application $context, Collection $collection) {
        if(is_null(static::$instance)) {
            static::$instance = new self($context, $collection);
        }
        return static::$instance;
    }

}