<?php

namespace Racoon\Core\Request\Route;

class RouteGroup {

    protected $setting;
    protected $group;

    public function __construct($closure) {
        $bundle = $closure(new RouteSetting(), new RouteCollection());
        $this->setting = $bundle->getSettings();
        $this->group = $bundle->getGroupContent()->getCollection();
        $this->applyProps();
    }

    /**
     * Apply prop setting to each route items.
     */

    private function applyProps() {
        foreach($this->group as $member) {
            $member->inject($this->setting);
        }
    }

}