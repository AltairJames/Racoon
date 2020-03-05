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

}