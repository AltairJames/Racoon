<?php

namespace Racoon\Core\Facade\Components;

abstract class FacadeBase {

    protected static $binded = [];
    protected static $callAs;

    /**
     * Bind services to facade.
     */

    protected static function bind($object) {
        $name = static::$callAs;
        if(!array_key_exists($name, static::$binded)) {
            static::$binded[$name] = $object;
        }
    }

    /**
     * Get binded service object.
     */

    protected static function getService(string $name) {
        if(array_key_exists($name, static::$binded)) {
            return static::$binded[$name];
        }
    }

    /**
     * Capture undefined static methods.
     */

    public static function __callStatic(string $method, $arguments) {
        $name = static::$callAs;
        $service = static::getService($name);
        if(is_null($service)) {
            static::set();
            $service = static::getService($name);
        }
        if(!is_null($service)) {
            if(method_exists($service, $method)) {
                return $service->{$method}(...$arguments);
            }
            else {
                if(method_exists($service, 'inherit')) {
                    return $service->inherit($method, $arguments);
                }
            }
        }
    }

    /**
     * Override this method from the child class to
     * get the service to bind to the facade.
     */

    protected static function set() {}

}