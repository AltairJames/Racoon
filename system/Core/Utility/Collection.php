<?php

namespace Racoon\Core\Utility;

class Collection {

    private $name;
    private $data;

    public function __construct(string $name, array $data = []) {
        $this->name = $name;
        $this->data = $data;
    }

    /**
     * Attach dynamic properties to this class.
     */

    public function __get(string $name) {
        if(array_key_exists($name, $this->data)) {
            $this->{$name} = $this->data[$name];
            return $this->{$name};   
        }
    }

    /**
     * Prevent value overriding to dynamic properties.
     */

    public function __set(string $name, $data) {}

}