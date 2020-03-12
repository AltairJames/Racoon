<?php

namespace Racoon\Core;

use App\Controller\HttpResponseController;
use Racoon\Core\Application\RuntimeManager;
use Racoon\Core\Facade\App;
use Racoon\Core\Request\Handler\MiddlewareService;
use Racoon\Core\Request\RequestManager;
use Racoon\Core\Utility\Collection;

class Application extends RuntimeManager {

    private static $instance;
    private $version;
    private $started = false;
    private $exited = false;

    /**
     * Runtime duration logging.
     */

    private $start_time;
    private $end_time;
    private $duration;

    private function __construct() {
        $this->start_time = microtime(true);
        $this->version = '1.0.0';
    }

    /**
     * Return root directory.
     */

    public function root() {
        return '../';
    }

    /**
     * Return current version of Racoon Framework.
     */

    public function version() {
        return $this->version;
    }

    /**
     * Start application services.
     */

    public function start() {
        if(!$this->started) {
            $this->started = true;
            $this->runtime();
        }
    }

    /**
     * Things to do during request.
     */

    private function runtime() {
        if(App::release() === 'debug') {
            $this->inDebugMode();
        }

        $manager = $this->startRequestManager();
        $controller = HttpResponseController::class;
        $code = 500;

        if($manager->success()) {
            $route = $manager->getRouteData();
            $middleware = MiddlewareService::set($this, $route, $manager->getResourceData());

            if($middleware->success()) {
                $controller = 'App\\Controller\\' . $route->controller;
                $code = 200;
            }
            else {
                $code = $middleware->getStatus();
            }
        }
        else {
            $code = 404;
        }

        $this->controllerInit($code, $controller, $manager->getResourceData());
        $this->setRequestHeaders();
    }

    /**
     * Proceed to the controller.
     */

    private function controllerInit(int $code, string $controller, Collection $resource) {
        $instance = new $controller();
        $instance->set();
    }

    /**
     * Set HTTP headers before returning response data.
     */

    private function setRequestHeaders() {

    }

    /**
     * Start request service to load and test
     * request route.
     */

    private function startRequestManager() {
        return RequestManager::start($this);
    }

    /**
     * Put application to debug mode.
     */

    private function inDebugMode() {

    }

    /**
     * Terminate application.
     */

    public function exit() {
        if($this->started && !$this->exited) {
           $this->exited = true;
           $this->end_time = microtime(true);
           $this->computeRuntimeDuration();
           exit(0);
        }
    }

    /**
     * Compute how much it takes to load each request.
     */

    private function computeRuntimeDuration() {
        
    }

    /**
     * Return application instance object.
     */

    public static function context() {
        return static::$instance;
    }

    /**
     * Create application object using singleton
     * to prevent multiple instantiation.
     */

    public static function init() {
        if(is_null(static::$instance)) {
            static::$instance = new self();
        }
        return static::$instance;
    }

}