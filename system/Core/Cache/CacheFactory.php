<?php

namespace Racoon\Core\Cache;

use Racoon\Core\Application;

class CacheFactory {

    protected $context;
    protected $type;
    protected $file;

    /**
     * Repository variables to prevent reloading
     * of cache files.
     */

    protected static $asset_repository;
    protected static $config_repository;
    protected static $route_repository;

    public function __construct(Application $context, string $type, string $file) {
        $this->context = $context;
        $this->type = $type;
        $this->file = $file;
    }

    /**
     * Return true if caching is enabled.
     */

    public function enabled() {
        return true;
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

            return json_decode(file_get_contents($this->file), true);
        }
    }

    /**
     * Create or rewrite cache file.
     */

    public function write(array $data) {
        $toString = json_encode($data);
        if($this->exist()) {
            $this->destroy($this->file);
        }

        $file = fopen($this->file, 'a+');
        fwrite($file, $toString);
        fclose($file);
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
    }

}