<?php

namespace Racoon\Core\Application;

abstract class RuntimeManager {

    /**
     * Make the application up or down.
     */

    protected $mode;

    public function up() {
        $this->mode = 'up';
    }

    public function down() {
        $this->mode = 'down';
    }

    public function getMode() {
        return $this->mode;
    }

    /**
     * Set or Get localization.
     */

    protected $locale = 'en';

    public function setLocale(string $lang) {
        $this->locale = $lang;
    }

    public function getLocale() {
        return $this->locale;
    }

}