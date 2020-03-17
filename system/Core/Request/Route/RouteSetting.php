<?php

namespace Racoon\Core\Request\Route;

class RouteSetting {

    protected $group;

    /**
     * Route properties that can be apply
     * to multiple routes in a group.
     */

    protected $props = [

        'middleware'        => null,

        'afterware'         => null,

        'mode'              => 'up',

        'auth'              => false,

        'cors'              => false,

        'expire'            => null,

        'maxRequest'        => null,

        'dataType'          => null,

        'https'             => false,

        'locale'            => 'en',

        'validate'          => [],

        'mobile'            => false,

        'blockIP'           => [],

        'allowOrigin'       => [],

        'allowAllOrigin'    => false,

    ];

    public function __construct() {}

    /**
     * Apply route settings to the group.
     */

    public function apply(RouteCollection $group) {
        $this->group = $group;
        return $this;
    }

    /**
     * Set route group middleware.
     */

    public function middleware(string $middleware) {
        $this->props['middleware'] = $middleware;
    }

    /**
     * Set route group afterware.
     */

    public function afterware(string $afterware) {
        $this->props['afterware'] = $afterware;
    }

    /**
     * Set route group to down mode.
     */

    public function down() {
        $this->props['mode'] = 'down';
    }

    /**
     * Set if route requires authentication.
     */

    public function requireAuthentication(bool $value) {
        $this->props['auth'] = $value;
    }

    /**
     * Set if cross origin request is allowed.
     */

    public function allowCrossOriginRequest(bool $value) {
        $this->props['cors'] = $value;
    }

    /**
     * Set timestamp when route group will be expired.
     */

    public function setExpire($expiration) {
        $this->props['expire'] = $expiration;
    }

    /**
     * Set maximum number of request allowed in this route group.
     */

    public function setMaximumRequest(int $max) {
        $this->props['maxRequest'] = $max;
    }

    /**
     * Set if https connection is required to access members
     * of route group.
     */

    public function requireHttps(bool $value) {
        $this->props['https'] = $value;
    }

    /**
     * Set the localization to use in routes.
     */

    public function setLocale(string $lang) {
        $this->props['locale'] = $lang;
    }

    /**
     * Set route accessibility to mobile devices.
     */

    public function mobileAccessibility(bool $cond) {
        $this->props['mobile'] = $cond;
    }

    /**
     * Return group members of route group.
     */

    public function getGroupContent() {
        return $this->group;
    }

    /**
     * Return route group setting data.
     */

    public function getSettings() {
        return $this->props;
    }

}