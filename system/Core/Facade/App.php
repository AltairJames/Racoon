<?php

namespace Racoon\Core\Facade;

use Racoon\Core\Application;
use Racoon\Core\Application\AppHelper;
use Racoon\Core\Facade\Components\FacadeBase;

class App extends FacadeBase {

    protected static $callAs = 'App';

    protected static function set() {
        static::bind(new AppHelper(Application::context()));
    }

}