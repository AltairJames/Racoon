<?php

namespace Racoon\Core\Application;

use Racoon\Core\Application;
use Racoon\Core\Facade\Cache;
use Racoon\Core\Utility\Collection;

class AppHelper {

    private $context;
    private $cache;

    public function __construct(Application $context) {   
        $this->context = $context;
    }

    /**
     * Return Racoon version.
     */

    public function version() {
        return $this->context->version();
    }

    /**
     * Return app root.
     */

    public function root() {
        return $this->context->root();
    }

    /**
     * Return application version.
     */

    public function context() {
        return $this->context;
    }

    /**
     * Try to return config/app.php data. Populate
     * application data.
     */

    private function loadCache() {
        if(is_null($this->cache)) {
            $this->cache = Cache::config()->app();

            $this->context->setRelease($this->cache['release']);
            
            if($this->cache['mode'] === 'up') {
                $this->context->up();
            }
            else {
                $this->context->down();
            }
            
            $this->context->setTimezone($this->cache['timezone']);
            $this->context->setLocale($this->cache['locale']);
            $this->context->setLocale2($this->cache['locale2']);
            $this->context->setMinify($this->cache['minify']);
        }
    }

    /**
     * Return deployment status.
     */

    public function release() {
        $this->loadCache();
        return $this->context->getRelease();
    }

    /**
     * Set application visibility or return current value.
     */

    public function mode(string $mode = null) {
        $this->loadCache();
        if(!is_null($mode)) {
            if(strtolower($mode) === 'up') {
                $this->up();
            }
            else {
                $this->down();
            }
        }
        else {
            return $this->context->getMode();
        }
    }

    /**
     * Make the application visible.
     */

    public function up() {
        $this->loadCache();
        $this->context->up();
    }

    /**
     * Make the application invisible.
     */

    public function down() {
        $this->loadCache();
        $this->context->down();
    }

    /**
     * Return informations about the application.
     */

    public function info() {
        $this->loadCache();
        return new Collection('info', $this->cache['info']);
    }

    /**
     * Set or return timezone.
     */

    public function timezone(string $region) {
        $this->loadCache();
        if(!is_null($region)) {
            $this->context->setTimezone($region);
        }
        else {
            return $this->context->getTimezone();
        }
    }

    /**
     * Return or set locale.
     */

    public function locale(string $lang = null) {
        $this->loadCache();
        if(!is_null($lang)) {
            $this->context->setLocale($lang);
        }
        else {
            return $this->context->getLocale();
        }
    }

    /**
     * Return or set locale2.
     */

    public function locale2(string $lang = null) {
        $this->loadCache();
        if(!is_null($lang)) {
            $this->context->setLocale2($lang);
        }
        else {
            return $this->context->getLocale2();
        }
    }

    /**
     * Return or set minify source-code value.
     */

    public function minify(bool $condition = null) {
        $this->loadCache();
        if(!is_null($condition)) {
            $this->context->setMinify($condition);
        }
        else {
            return $this->context->getMinify();
        }
    }

}