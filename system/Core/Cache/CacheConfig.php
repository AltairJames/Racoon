<?php

namespace Racoon\Core\Cache;

use Racoon\Core\Facade\App;

class CacheConfig extends CacheBase {

    protected $path;
    protected $ext = '.php';

    protected $factory;
    protected $context;
    protected $file;
    protected $data = [];

    protected $app_data;
    protected $handler_data;

    public function __construct(CacheFactory $factory) {
        $this->factory = $factory;
        $this->context = $factory->getContext();
        $this->file = $factory->getFile();

        $this->path = App::root() . 'config/';
        $cache_enable = $factory->configData('config');
        
        if($factory->exist() && $factory->enabled()) {
            $this->data = $factory->read();

            if($cache_enable['app'] ?? false) {
                $this->app_data = $this->data['app'] ?? null;
            }

            if($cache_enable['handler'] ?? false) {
                $this->handler_data = $this->data['handler'] ?? null;
            }
        }
    }

    /**
     * Return cached data from config/app.php
     */

    public function app() {
        return $this->load('app', $this->path . 'app' . $this->ext);
    }

    /**
     * Return cached data from config/handler.php
     */

    public function handler() {
        return $this->load('handler', $this->path . 'handler' . $this->ext);
    }

}