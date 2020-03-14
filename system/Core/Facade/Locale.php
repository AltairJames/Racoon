<?php

namespace Racoon\Core\Facade;

use Racoon\Core\Facade\Components\FacadeBase;
use Racoon\Lib\Locale\LocaleManager;

class Locale extends FacadeBase {

    protected static $callAs = 'Locale';

    protected static function set() {
        $locale = App::locale();
        $locale2 = App::locale2();
        static::bind(new LocaleManager($locale, $locale2));
    }

}