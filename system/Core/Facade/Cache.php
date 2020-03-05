<?php

namespace Racoon\Core\Facade;

use Racoon\Core\Application;
use Racoon\Core\Cache\CacheManager;
use Racoon\Core\Facade\Components\FacadeBase;

class Cache extends FacadeBase {

    protected static $callAs = 'Cache';

    protected static function set() {
        static::bind(new CacheManager(Application::context()));
    }

}