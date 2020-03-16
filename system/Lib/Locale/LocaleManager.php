<?php

namespace Racoon\Lib\Locale;

class LocaleManager {

    protected $locale;
    protected $locale2;

    public function __construct(string $locale, string $locale2) {
        $this->locale = $locale;
        $this->locale2 = $locale2;
    }

    /**
     * Return default locale to use.
     */

    public function getLocale() {
        return $this->locale;
    }

    /**
     * Fallback locale to use.
     */

    public function getLocale2() {
        return $this->locale2;
    }

    /**
     * Set locale id and instantiate locale.
     */

    public function id(string $id) {
        return new LocaleFactory($this, $id);
    }

}