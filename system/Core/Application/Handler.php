<?php

namespace Racoon\Core\Application;

class Handler {

    protected function __construct() {
        
    }

    /**
     * Instantiate handler instance.
     */

    public static function set() {
        return new self();
    }

}