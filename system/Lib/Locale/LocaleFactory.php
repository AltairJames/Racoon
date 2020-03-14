<?php

namespace Racoon\Lib\Locale;

class LocaleFactory extends LocaleTranslations {

    protected static $locale = [];

    protected $id;
    protected $label = [];

    public function __construct(string $id) {
        $this->id = $id;

        if(!array_key_exists($id, static::$locale)) {
            static::$locale[$id] = $this;
        }
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
        $cache = static::$locale;
        static::$locale = [];
        return $cache;
    }

}