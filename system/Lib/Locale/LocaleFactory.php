<?php

namespace Racoon\Lib\Locale;

class LocaleFactory extends LocaleTranslations {

    protected static $locales = [];

    protected $id;
    protected $label = [];
    protected $locale;
    protected $locale2;

    public function __construct(LocaleManager $manager, string $id) {
        $this->id = $id;

        if(!array_key_exists($id, static::$locales)) {
            static::$locales[$id] = $this;
        }
    }

    /**
     * Call dynamic methods for translations.
     */

    public function __call($key, $arguments) {
        if(array_key_exists($key, $this->languages)) {
            $this->label[$key] = $arguments[0];
        }
        return $this;
    }

    /**
     * Return locale id.
     */

    public function getId() {
        return $this->id;
    }

    /**
     * Return label data.
     */

    public function getLabelData() {
        return $this->label;
    }

    /**
     * Get all registered locale.
     */

    public static function getRegisteredLocale() {
        $cache = static::$locales;
        static::$locales = [];
        return $cache;
    }

}