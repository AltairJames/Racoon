<?php

namespace Racoon\Core\Application;

use Racoon\Core\Request\Bundle;
use Racoon\Core\Request\Handler\HandlerUtil;

abstract class Afterware extends HandlerUtil {

    /**
     * Start observing handler response.
     */

    public function set(Bundle $bundle) {
        $this->status = 500;
        $this->success = false;
        $observe = $this->observe($bundle);

        if(is_bool($observe) && $observe) {
            $this->success = true;
        }

        if($this->success) {
            $this->log();
        }
    }

    /**
     * Require this methods in handler classes.
     */

    abstract protected function observe(Bundle $bundle);

    abstract protected function log();

}