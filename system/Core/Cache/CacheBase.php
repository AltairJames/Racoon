<?php

namespace Racoon\Core\Cache;

abstract class CacheBase {

    /**
     * Test if file is not yet loaded and cached.
     */

    protected function load(string $name, string $file) {
        if(is_null($this->{$name . '_data'})) {
            $this->data[$name] = $this->loadFile($file);
            $this->{$name . '_data'} = $this->data[$name];
            $this->factory->write($this->data);
        }
        return $this->{$name . '_data'};
    }

    /**
     * Load array file to be cached.
     */

    private function loadFile(string $file) {
        if(file_exists($file) && is_readable($file)) {
            return require $file;
        }
    }

}