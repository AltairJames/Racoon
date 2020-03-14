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
         * -----------------------------------------
         */

        'middleware'    => [

            /**
             * Default middleware group.
             */

            'default'   => 'generic',

            /**
             * Middleware groups.
             */

            'groups'    => [

                'generic'   => [

                    App\Handler\Middleware\BaseRequestMiddleware::class,
                    App\Handler\Middleware\RequestMethodMiddleware::class,

                ],

                /**
                 * You can define middleware groups below.
                 */

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

            /**
             * Default afterware group.
             */

            'default'    => 'generic',

            /**
             * Middleware groups.
             */

            'groups'     => [

                'generic'   => [

                    App\Handler\Afterware\ResponseContentAfterware::class,

                ],

                /**
                  * You can define afterware groups below.
                  */

            ],

        ],

    ];