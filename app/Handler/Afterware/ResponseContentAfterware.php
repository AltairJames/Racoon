<?php

namespace App\Handler\Afterware;

use Racoon\Core\Application\Afterware;
use Racoon\Core\Request\Bundle;

class ResponseContentAfterware extends Afterware {

    protected $code = 204;

    protected function observe(Bundle $bundle) {
    $response = $bundle->response;
    $code = $this->code;

        if(!is_null($response)) {

            if(is_string($response) && strlen($response) === 0) {
                return $this->response($code);
            }
            else if(is_array($response) && empty($response)) {
                return $this->response($code);
            }

        }
        else {
            return $this->response($code);
        }

        return $this->next();
    }

    protected function log() {}

}