<?php

namespace Racoon\Core;

use Racoon\Core\Application\RuntimeManager;
use Racoon\Core\Facade\App;

class Application extends RuntimeManager {

    private static $instance;
    private $version;
    private $started = false;
    private $exited = false;

    /**
     * Runtime duration logging.
     */

    private $start_time;
    private $end_time;
    private $duration;

    private function __construct() {
        $this->start_time = microtime(true);
        $this->version = '1.0';
    }

    /**
     * Return root directory.
     */

    public function root() {
        return '../';
    }

    /**
     * Return current version of Racoon Framework.
     */

    public function version() {
        return $this->version;
    }

    /**
     * Start application services.
     */

    public function start() {
        if(!$this->started) {
            $this->started = true;
            $this->runtime();
        }
    }

    /**
     * Things to do during request.
     */

    private function runtime() {
        $release = App::release();

    }   

    /**
     * Terminate application.
     */

    public function exit() {
        if($this->started && !$this->exited) {
           $this->exited = true;
           $this->end_time = microtime(true);
           $this->computeRuntimeDuration();
           exit(0);
        }
    }

    /**
     * Compute how much it takes to load each request.
     */

    private function computeRuntimeDuration() {

    }

    /**
     * Return application instance object.
     */

    public static function context() {
        return static::$instance;
    }

    /**
     * Create application object using singleton
     * to prevent multiple instantiation.
     */

    public static function init() {
        if(is_null(static::$instance)) {
            static::$instance = new self();
        }
        return static::$instance;
    }

}