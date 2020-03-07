<?php

namespace Racoon\Core\Facade;

use Racoon\Core\Facade\Components\FacadeBase;
use Racoon\Core\Request\Route\RouteFactory;

class Route extends FacadeBase {

    protected static $callAs = 'Route';

    protected static function set() {
        static::bind(new RouteFactory(App::context()));
    }

}