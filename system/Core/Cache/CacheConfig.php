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

    public function __construct(CacheFactory $factory) {
        $this->factory = $factory;
        $this->context = $factory->getContext();
        $this->file = $factory->getFile();

        $this->path = App::root() . 'config/';
        
        if($factory->exist() && $factory->enabled()) {
            $this->data = $factory->read();

            $this->app_data = $this->data['app'] ?? null;
        }
    }

    /**
     * Return cached data from config/app.php
     */

    public function app() {
        return $this->load('app', $this->path . 'app' . $this->ext);
    }

}