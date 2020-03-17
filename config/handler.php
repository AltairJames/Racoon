<?php

    /**
     * -----------------------------------------
     *  HANDLER
     * -----------------------------------------
     *  Handlers are PHP classes used to filter,
     *  validate and evaluate each request. The
     *  request must satisfy all handlers in
     *  order to fetch the resource requested.
     * -----------------------------------------
     */

    return [

        /**
         * -----------------------------------------
         *  MIDDLEWARE
         * -----------------------------------------
         *  Middlewares are handlers executed in
         *  each request before entering controller.
         *  You can define your own middleware but
         *  the middleware service will still run
         *  the generic middleware.
         * -----------------------------------------
         */

        'middleware'    => [

            'generic'   => [

                App\Handler\Middleware\BaseRequestMiddleware::class,
                App\Handler\Middleware\RequestMethodMiddleware::class,
                App\Handler\Middleware\RequestProtocolMiddleware::class,
                App\Handler\Middleware\IPBlockerMiddleware::class,
                App\Handler\Middleware\CrossOriginRequestMiddleware::class,
                App\Handler\Middleware\UseragentMiddleware::class,
                App\Handler\Middleware\RouteExpirationMiddleware::class,

            ],

        ],

        /**
         * -----------------------------------------
         *  AFTERWARE
         * -----------------------------------------
         *  Afterwares are handlers excuted in each
         *  request after controller and before
         *  displaying the response.
         * -----------------------------------------
         */

        'afterware'      => [

            'generic'   => [

                App\Handler\Afterware\ResponseContentAfterware::class,
                App\Handler\Afterware\RedirectionAfterware::class,

            ],

        ],

    ];