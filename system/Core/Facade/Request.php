<?php

namespace Racoon\Core\Facade;

use Racoon\Core\Facade\Components\FacadeBase;
use Racoon\Core\Request\RequestData;

class Request extends FacadeBase {

    protected static $callAs = 'Request';

    protected static function set() {
        static::bind(new RequestData(App::context()));
    }

}