<?php

namespace Racoon\Core\Request;

use Racoon\Core\Application;
use Racoon\Core\Facade\Cache;
use Racoon\Core\Facade\Request;
use Racoon\Core\Facade\Str;
use Racoon\Core\Utility\Collection;

class RequestManager {

    private static $instance;
    private $context;
    private $success = false;
    private $routes;
    private $route;
    private $uri;

    private function __construct(Application $context) {
        $this->context = $context;
        $this->uri = Request::uri();
        $this->init();
    }

    /**
     * Start step by step process of request handling.
     */

    private function init() {
        $cached = Cache::route($this->uri);

        /**
         * If uri is still not cached, generate cache file.
         */
        
        if(is_null($cached)) {
            $this->routes = Cache::routes();
        }
        else {
            $this->routes = $cached;
        }

        $this->findURIFromList();
    }

    /**
     * Check if request URI is in the routes list.
     */

    private function findURIFromList() {
        $uri1 = $this->uriToArray($this->uri);
        for($i = 0; $i <= (sizeof($this->routes) - 1); $i++) {
            $uri2 = $this->uriToArray($this->routes[$i]['uri']);
            $hits = 0;
            
            if(sizeof($uri1) === sizeof($uri2)) {
                for($j = 0; $j <= (sizeof($uri2) - 1); $j++) {
                    if(Str::equal($uri1[$j], $uri2[$j])) {
                        $hits++;
                    }
                    else {
                        if(Str::first($uri2[$j]) === '{' && Str::last($uri2[$j]) === '}') {
                            $hits++;
                        }
                    }
                }
            }

            if($hits === sizeof($uri1)) {
                $this->route = $this->routes[$i];
                $this->success = true;
                break;
            }
        }
    }

    /**
     * Convert URI to array.
     */

    private function uriToArray(string $uri) {
        $last = Str::last($uri);
        if($last === '/') {
            $uri = Str::move($uri, 0, 1);
        }
        
        $split = explode('/', $uri);
        array_shift($split);
        return $split;
    }

    /**
     * Return collection of route data.
     */

    public function getRouteData() {
        return new Collection('Route Data', $this->route);
    }

    /**
     * Return success status.
     */

    public function success() {
        return $this->success;
    }

    /**
     * Instantiate this service using singleton
     * pattern to prevent multiple instantiation.
     */

    public static function start(Application $context) {
        if(is_null(static::$instance)) {
            static::$instance = new self($context);
        }
        return static::$instance;
    }

}