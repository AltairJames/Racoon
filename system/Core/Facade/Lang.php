<?php

namespace Racoon\Core\Facade;

use Racoon\Core\Facade\Components\FacadeBase;
use Racoon\Lib\Locale\LocaleInterface;

class Lang extends FacadeBase {

    protected static $callAs = 'Lang';

    protected static function set() {
        static::bind(new LocaleInterface());
    }

}