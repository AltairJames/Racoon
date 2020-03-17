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
    protected $security_data;

    protected $enables;

    public function __construct(CacheFactory $factory) {
        $this->factory = $factory;
        $this->context = $factory->getContext();
        $this->file = $factory->getFile();

        $this->path = App::root() . 'config/';
        $this->enables = $factory->configData('config');
        
        if($factory->exist() && $factory->enabled()) {
            $this->data = $factory->read();

            if($this->enables['app'] ?? false) {
                $this->app_data = $this->data['app'] ?? null;
            }

            if($this->enables['handler'] ?? false) {
                $this->handler_data = $this->data['handler'] ?? null;
            }

            if($this->enables['security'] ?? false) {
                $this->security_data = $this->data['security'] ?? null;
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

    /**
     * Return cached data from config/security.php
     */

    public function security() {
        return $this->load('security', $this->path . 'security' . $this->ext);
    }

}