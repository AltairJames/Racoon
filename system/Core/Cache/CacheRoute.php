<?php

namespace Racoon\Core\Cache;

use Racoon\Core\Utility\Collection;

class CacheRoute extends CacheUtil {

    private $data;

    public function __construct(CacheFactory $factory) {
        $cache_enable = $factory->configData('routes') ?? false;
        if($factory->exist() && $factory->enabled() && $cache_enable) {
            $this->data = $factory->read();
        }
    }

    /**
     * Return cached route data.
     */

    public function getData() {
        if(!is_null($this->data)) {
            return new Collection('Route Data', $this->data);
        }
    }

}