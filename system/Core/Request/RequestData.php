<?php

namespace Racoon\Core\Request;

use Racoon\Core\Application;

class RequestData {

    private $context;

    public function __construct(Application $context) {
        $this->context = $context;
    }

    /**
     * Return request method used.
     */

    public function method() {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Return boolean if request is through ajax.
     */

    public function isAjax() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    /**
     * Return request uri.
     */

    public function uri() {
        return $_SERVER['REQUEST_URI'];
    }

    /**
     * Return time request is initiated.
     */

    public function requested() {
        return $_SERVER['REQUEST_TIME'];
    }

    /**
     * Return GET parameter data.
     */

    public function get(string $name, $default = null) {
        return array_key_exists($name, $_GET) ? $_GET[$name] : $default;
    }

    /**
     * Return POST parameter data.
     */

    public function post(string $name, $default = null) {
        return array_key_exists($name, $_POST) ? $_POST[$name] : $default;
    }

}