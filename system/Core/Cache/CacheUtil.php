<?php

namespace Racoon\Core\Cache;

use Racoon\Core\Facade\App;

abstract class CacheUtil {

    protected $path = 'repository/cache/';
    protected $ext = '.che';

    /**
     * Generate cache file name.
     */

    protected function serialize(string $name) {
        return md5($name);
    }

    /**
     * Generate cache file path.
     */

    protected function makePath(string $type, string $name) {
        return App::root() . $this->path . $type . '/' . $this->serialize($name) . $this->ext;
    }

}