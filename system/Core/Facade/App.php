<?php

namespace Racoon\Core\Facade;

use Racoon\Core\Facade\Components\FacadeBase;

class App extends FacadeBase {

    /**
     * Register aliases to this facade.
     */

    protected function set() {
        return $this->register('release', function() {
            return 'deploy';
        });
    }

}