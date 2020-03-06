<?php

namespace Racoon\Core\Cache;

use Racoon\Core\Facade\App;

class CacheRoutes {

    private $factory;
    private $ext = '.php';
    private $path;
    private $file = 'routes';

    public function __construct(CacheFactory $factory) {
        $this->factory = $factory;
        $this->path = App::root() . 'routes/';

        if($factory->exist() && $factory->enabled()) {
            
        }
    }

}