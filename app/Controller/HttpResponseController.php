<?php

namespace App\Controller;

use Racoon\Core\Application\Controller;
use Racoon\Core\Facade\Lang;
use Racoon\Core\Request\Bundle;

class HttpResponseController extends Controller {

    protected function index(Bundle $bundle) {
        $code = $bundle->emit->code;
        $desc = Lang::get('http::status.code.name.' . $code);
            
        return $desc;
    }

}