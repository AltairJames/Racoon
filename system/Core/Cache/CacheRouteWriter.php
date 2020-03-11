<?php

namespace Racoon\Core\Cache;

class CacheRouteWriter {

    protected $factory;
    protected $data;

    public function __construct(CacheFactory $factory, array $data) {
        $this->factory = $factory;
        $this->data = $data;
        $enable = $factory->configData('routes') ?? false;

        if(!$factory->exist() && $factory->enabled() && $enable) {
            $this->writeCache();    
        }
    }

    /**
     * Write cache file from the factory.
     */

    protected function writeCache() {
        $this->factory->write($this->data);
    }

}