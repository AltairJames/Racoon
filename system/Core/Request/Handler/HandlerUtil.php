<?php

namespace Racoon\Core\Request\Handler;

abstract class HandlerUtil {

    protected $status = 500;
    protected $success = false;
    protected $redirect = null;

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

}