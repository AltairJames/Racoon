<?php

namespace Racoon\Core;

use App\Controller\HttpResponseController;
use Racoon\Core\Application\RuntimeManager;
use Racoon\Core\Facade\App;
use Racoon\Core\Request\Handler\AfterwareService;
use Racoon\Core\Request\Handler\MiddlewareService;
use Racoon\Core\Request\RequestHeader;
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
        $method = 'index';
        $code = 500;
        $route = null;

        if($manager->success()) {
            $route = $manager->getRouteData();
            $middleware = MiddlewareService::set($this, $route, $manager->getResourceData());

            if($middleware->success()) {
                $controller = 'App\\Controller\\' . $route->controller;
                $method = $route->method;
                $code = 200;
            }
            else {
                $code = $middleware->getStatus();
                if($code === 307) {
                    $this->forcedRedirection($middleware->getRedirect());
                    exit(0);
                }
            }
        }
        else {
            $code = 404;
        }

        $response = $this->controllerInit($code, $controller, $method, $route, $manager->getResourceData());
        $afterware = AfterwareService::set($this, $route, $manager->getResourceData(), $response);

        if($afterware->success()) {
            $code = 200;
        }
        else {
            $code = $afterware->getStatus();
            if($code === 307) {
                $this->forcedRedirection($afterware->getRedirect());
                exit(0);
            }

            $controller = HttpResponseController::class;
            $response = $this->controllerInit($code, $controller, 'index', $route, $manager->getResourceData());
        }

        $header = $this->setRequestHeaders($code, $route, $response);
        $this->displayResponse($response);
    }

    /**
     * Display or print response.
     */

    private function displayResponse($response) {
        if(is_string($response)) {
            if(App::minify()) {
                echo $this->minify($response);
            }
            else {
                echo $response;
            }
        }
        else if(is_array($response)) {
            echo json_encode($response);
        }
        else if(is_int($response)) {
            echo $response;
        }
    }

    /**
     * Minify response string by removing all whitespaces.
     */

    private function minify(string $response) {
        return $response;
    }

    /**
     * Proceed to the controller.
     */

    private function controllerInit(int $code, string $controller, string $method, Collection $route = null, Collection $resource = null) {
        $emit = [];
        if($code !== 200) {
            $emit = [
                'code'  => $code,
            ];
        }
        
        $instance = new $controller();
        $response = $instance->set($method, $route, $resource, $emit);

        return $response;
    }

    /**
     * Redirect to requested URI.
     */

    private function forcedRedirection(string $uri) {
        header('location: ' . $uri);    
    }

    /**
     * Set HTTP headers before returning response data.
     */

    private function setRequestHeaders(int $code, Collection $route = null, $response = null) {
        return RequestHeader::set($code, $route, $response);
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