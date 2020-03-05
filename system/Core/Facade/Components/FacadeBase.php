<?php

namespace Racoon\Core\Facade\Components;

class FacadeBase {

    /**
     * Capture undefined static methods.
     */

    public static function __callStatic(string $name, $arguments) {
        
    }

    protected function set() {

    }

    protected function register(string $alias, $closure) {

    }

}