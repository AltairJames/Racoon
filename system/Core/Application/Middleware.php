<?php

namespace Racoon\Core\Application;

use Racoon\Core\Request\Bundle;

abstract class Middleware {

    private $status = 500;
    private $success = false;
    private $redirect = null;

    /**
     * Return http status.
     */

    protected function response(int $status) {
        $this->status = $status;

        if($status === 200) {
            $this->success = true;
        }
    }

    /**
     * Terminate handler service and request redirection.
     */

    protected function redirect(string $uri) {
        $this->status = 307;
        $this->redirect = $uri;
    }

    /**
     * Go to the next handler.
     */

    protected function next() {
        $this->success = true;
    }

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
    }

    /**
     * Return true if handler testing is success.
     */

    public function success() {
        return $this->success;
    }

    /**
     * Return http status code.
     */

    public function getStatus() {
        return $this->status;
    }

    /**
     * Get requested redirection uri.
     */

    public function getRedirectionURI() {
        return $this->redirect;
    }

    /**
     * Require this methods in handler classes.
     */

    abstract protected function observe(Bundle $bundle);

    abstract protected function log();

}