<?php

namespace Racoon\Core\Cache;

use Racoon\Core\Application;

class CacheManager extends CacheUtil {

    private $context;

    public function __construct(Application $context) {
        $this->context = $context;
    }

    private function makeFactory(string $type, string $name) {
        return new CacheFactory($this->context, $name, $this->makePath($type, $name));
    }

    /**
     * Return cached config instance.
     */

    public function config() {
        return $this->makeFactory('bin', 'config')->make();
    }

    /**
     * Return cached asset instance.
     */

    public function asset() {
        return $this->makeFactory('bin', 'asset')->make();
    }

    /**
     * Return routes asset instance.
     */

    public function routes() {
        return $this->makeFactory('bin', 'routes')->make();
    }

    /**
     * Return uri cached route data.
     */

    public function route(string $uri) {
        $instance = new CacheFactory($this->context, 'route', $this->makePath('routes', $uri));
        return $instance->make();
    }

}