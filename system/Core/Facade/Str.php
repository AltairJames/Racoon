<?php

namespace Racoon\Core\Facade;

use Racoon\Core\Facade\Components\FacadeBase;
use Racoon\Core\Utility\Helper\StringHelper;

class Str extends FacadeBase {

    protected static $callAs = 'Str';

    protected static function set() {
        static::bind(new StringHelper());
    }

}