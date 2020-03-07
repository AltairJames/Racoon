<?php

namespace Racoon\Core\Request\Route;

use Racoon\Core\Application;

class WebRoute extends RouteBase {

    protected $context;
    protected $uri;
    protected $argument;

    public function __construct(Application $context, string $uri, $argument) {
        $this->context = $context;
        $this->uri = $uri;
        $this->argument = $argument;
    
        /**
         * Set default properties of web routes.
         */

        $this->data['type'] = 'web';
        $this->data['verb'][] = 'get';
        $this->data['uri'] = $uri;
        $this->setDefaultProps($argument);
    }

}