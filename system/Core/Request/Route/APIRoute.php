<?php

namespace Racoon\Core\Request\Route;

use Racoon\Core\Application;

class APIRoute extends RouteBase {

    protected $context;
    protected $uri;
    protected $argument;

    public function __construct(Application $context, string $uri, $argument) {
        $this->context = $context;
        $this->uri = $uri;
        $this->argument = $argument;

        $this->data['type'] = 'api';
        $this->data['uri'] = $uri;
        $this->data['dataType'] = $this->dataTypes['json'];
        $this->setDefaultProps($argument);
    }

    /**
     * Set HTTP verbs.
     */

    public function get() {
        if($this->testVerb('get')) {
            $this->data['verb'][] = 'get';
        }
        return $this;
    }

    public function post() {
        if($this->testVerb('post')) {
            $this->data['verb'][] = 'post';
        }
        return $this;
    }

    public function put() {
        if($this->testVerb('put')) {
            $this->data['verb'][] = 'put';
        }
        return $this;
    }

    public function patch() {
        if($this->testVerb('patch')) {
            $this->data['verb'][] = 'patch';
        }
        return $this;
    }

    public function delete() {
        if($this->testVerb('delete')) {
            $this->data['verb'][] = 'delete';
        }
        return $this;
    }

    /**
     * Set content data type to respond.
     */

    public function setDataType(string $type) {
        if(array_key_exists($type, $this->dataTypes)) {
            $this->data['dataType'] = $this->dataTypes[$type];
        }
        return $this;
    }

}