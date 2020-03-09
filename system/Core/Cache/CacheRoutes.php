<?php

namespace Racoon\Core\Cache;

use Racoon\Core\Facade\App;
use Racoon\Core\Request\Route\RouteFactory;

class CacheRoutes {

    private $factory;
    private $files;
    private $routes = [];
    private $path;

    public function __construct(CacheFactory $factory) {
        $this->factory = $factory;
        $this->path = App::root() . 'routes/';
        $cache_enable = $factory->configData('routes') ?? false;

        if($factory->exist() && $factory->enabled() && $cache_enable) {
            $this->routes = $factory->read();
        }

        if(empty($this->routes)) {
            $this->files = $this->getRouteFiles();
            $this->loadAllRoutes();
        }
    }

    /**
     * Return array of files from routes folder.
     */

    private function getRouteFiles() {
        return array_diff(scandir($this->path), ['.', '..']);
    }

    /**
     * Load and cache all routes file from routes folder.
     */

    private function loadAllRoutes() {
        foreach($this->files as $file) {
            $this->load($this->path . $file);
        }

        $routes = RouteFactory::getRouteList();
        foreach($routes as $route) {
            $this->routes[] = $route->getArrayData();
        }

        if($this->factory->enabled()) {
            $this->factory->write($this->routes);
        }
    }

    /**
     * Load the route file.
     */

    private function load(string $path) {
        if(file_exists($path) && is_readable($path)) {
            require $path;
        }
    }

    /**
     * Return array of routes data.
     */

    public function getRoutes() {
        return $this->routes;
    }

}