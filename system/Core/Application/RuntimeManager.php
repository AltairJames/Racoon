<?php

namespace Racoon\Core\Application;

abstract class RuntimeManager {

    /**
     * Application deployment status.
     */

    protected $release;

    public function setRelease(string $release) {
        $this->release = $release;
    }

    public function getRelease() {
        return $this->release;
    }

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
     * Set or return application timezone.
     */

    protected $timezone;

    public function setTimezone(string $region) {
        $this->timezone = $region;
    }

    public function getTimezone() {
        return $this->timezone;
    }

    /**
     * Set or Get localization.
     */

    protected $locale;

    public function setLocale(string $lang) {
        $this->locale = $lang;
    }

    public function getLocale() {
        return $this->locale;
    }

    /**
     * Set or Get fallback localization.
     */

    protected $locale2;

    public function setLocale2(string $lang) {
        $this->locale2 = $lang;
    }

    public function getLocale2() {
        return $this->locale2;
    }

    /**
     * Set or return minify source-code.
     */

    protected $minify;

    public function setMinify(bool $condition) {
        $this->minify = $condition;
    }

    public function getMinify() {
        return $this->minify;
    }

}