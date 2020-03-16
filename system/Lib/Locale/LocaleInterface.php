<?php

namespace Racoon\Lib\Locale;

use Racoon\Core\Facade\App;
use Racoon\Core\Facade\Cache;

class LocaleInterface extends LocaleTranslations {

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

    public function inherit(string $lang, $args) {
        $id = $args[0];
        $temp = $args[1] ?? [];
        return $this->get($id, $lang, $temp);
    }

    /**
     * Return translation by id.
     */

    public function get(string $id, string $lang = null, array $temp = []) {
        $split = explode('::', $id);
        $file = $split[0];
        $name = $split[1];

        if(array_key_exists($file, $this->data)) {
            $pool = $this->data[$file];
            
            if(array_key_exists($name, $pool)) {
                $sel = $pool[$name];
                
                if(is_null($lang)) {
                    if(array_key_exists($this->locale, $sel)) {
                        return $this->evalTemplate($sel[$this->locale], $temp);
                    }
                    else if(array_key_exists($this->locale2, $sel)) {
                        return $this->evalTemplate($sel[$this->locale2], $temp);
                    }
                }
                else {
                    if(array_key_exists($lang, $sel)) {
                        return $this->evalTemplate($sel[$lang], $temp);
                    }
                }
            }
        }

        return $id;
    }

    /**
     * Replace template markers with the text provided.
     */

    private function evalTemplate(string $text, array $props) {
        if(!empty($props)) {
            foreach($props as $key => $str) {
                $text = str_replace('${' . $key . '}', $str, $text);
            }
        }
        return $text;
    }

}