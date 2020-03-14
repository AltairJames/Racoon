<?php

namespace Racoon\Core\Request;
class Bundle {

    private $data;

    public function __construct(array $data) {
        $this->data = $data;
    }

    public function __get($key) {
        if(array_key_exists($key, $this->data)) {
            $this->{$key} = $this->data[$key];
            return $this->data[$key];
        }
    }

    public function __set($key, $val) {}

}