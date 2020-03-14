<?php

namespace Racoon\Lib\Locale;

use Racoon\Core\Facade\App;
use Racoon\Core\Facade\Cache;

class LocaleInterface {

    private static $cache;
    private $data;
    private $locale;
    private $locale2;

    public function __construct() {
        if(is_null(static::$cache)) {
            static::$cache = Cache::asset()->locale();
        }

        $this->locale = App::locale();
        $this->locale2 = App::locale2();
        $this->data = static::$cache;
    }

    /**
     * Return translation by id.
     */

    public function get(string $id) {
        $split = explode('::', $id);
        $file = $split[0];
        $name = $split[1];

        if(array_key_exists($file, $this->data)) {
            $pool = $this->data[$file];
            
            if(array_key_exists($name, $pool)) {
                $sel = $pool[$name];
                return $sel[$this->locale] ?? ($sel[$this->locale2] ?? null);
            }
        }
    }

}