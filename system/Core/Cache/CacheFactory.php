<?php

namespace Racoon\Core\Cache;

use Racoon\Core\Application;

class CacheFactory {

    protected $context;
    protected $type;
    protected $file;

    private $cache_config_path;

    /**
     * Repository variables to prevent reloading
     * of cache files.
     */

    protected static $asset_repository;
    protected static $config_repository;
    protected static $route_repository;

    protected static $cache_config;

    public function __construct(Application $context, string $type, string $file) {
        $this->context = $context;
        $this->type = $type;
        $this->file = $file;
        $this->cache_config_path = $context->root() . 'config/cache.php';
        $this->loadCacheConfig();
    }

    /**
     * Load config file for cache settings.
     */

    private function loadCacheConfig() {
        if(file_exists($this->cache_config_path) && is_readable($this->cache_config_path)) {
            if(is_null(static::$cache_config)) {
                static::$cache_config = require $this->cache_config_path;
            }
        }
    }

    /**
     * Test if module to cache is enabled.
     */

    public function configData(string $type) {
        return static::$cache_config[$type];
    }

    /**
     * Return true if caching is enabled. If release is in debug
     * mode, caching is automatically disabled.
     */

    public function enabled() {
        return static::$cache_config['enable'];
    }
    
    /**
     * Return application context.
     */

    public function getContext() {
        return $this->context;
    }

    /**
     * Return generated file name.
     */

    public function getFile() {
        return $this->file;
    }

    /**
     * Check if file name already exist.
     */

    public function exist() {
        return file_exists($this->file) && is_readable($this->file);
    }

    /**
     * Read and return data of cache file.
     */

    public function read() {
        if($this->exist()) {
            
            if($this->type === 'config' && !is_null(static::$config_repository)) {
                return static::$config_repository;
            }

            if($this->type === 'asset' && !is_null(static::$asset_repository)) {
                return static::$asset_repository;
            }

            if($this->type === 'routes' && !is_null(static::$route_repository)) {
                return static::$route_repository;
            }

            $fetch = json_decode(file_get_contents($this->file), true);

            $this->store($this->type, $fetch);
            return $fetch;
        }
    }

    /**
     * Store data to repository.
     */

    private function store(string $type, array $data) {
        if($this->type === 'config') {
            static::$config_repository = $data;
        }
        else if($this->type === 'asset') {
            static::$asset_repository = $data;
        }
        else if($this->type === 'routes') {
            static::$route_repository = $data;
        }
    }

    /**
     * Create or rewrite cache file.
     */

    public function write(array $data) {
        if($this->enabled()) {
            $toString = json_encode($data);
            
            if($this->exist()) {
                $this->destroy($this->file);
            }

            $file = fopen($this->file, 'a+');
            fwrite($file, $toString);
            fclose($file);

            $this->store($this->type, $data);
        }
    }

    /**
     * Delete cache file.
     */

    public function destroy(string $file) {
        unlink($file);
    }

    /**
     * Call cache and return instance.
     */

    public function make() {
        if($this->type === 'config') {
            return new CacheConfig($this);
        }
        else if($this->type === 'asset') {
            return new CacheAsset($this);
        }
        else if($this->type === 'routes') {
            $cache = new CacheRoutes($this);           
            return $cache->getRoutes();
        }
        else if($this->type === 'route') {
            $cache = new CacheRoute($this);
            return $cache->getData();
        }
    }

    /**
     * Write cache file exclusively for routes.
     */

    public function writeFile(array $data) {
        if($this->type === 'route' && !$this->exist() && $this->enabled()) {
            return new CacheRouteWriter($this, $data);
        }
    }

}