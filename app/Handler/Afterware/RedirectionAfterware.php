<?php

namespace App\Handler\Afterware;

use Racoon\Core\Application\Afterware;
use Racoon\Core\Request\Bundle;

class RedirectionAfterware extends Afterware {

    protected function observe(Bundle $bundle) {
    $route = $bundle->route ?? null;

        if(!is_null($route)) {
            if(!is_null($route->redirect)) {
                return $this->redirect($bundle->route->redirect);
            }
        }

        return $this->next();
    }

    protected function log() {}

}