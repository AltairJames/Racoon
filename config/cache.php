<?php

    return [

        /**
         * -----------------------------------------
         *  ENABLE CACHE 
         * -----------------------------------------
         *  Increase performance by caching static
         *  resources to decrease loading time.
         *  Caching is always disabled when project
         *  deployment status is in debug mode.
         * -----------------------------------------
         */

        'enable'       => true,

        /**
         * -----------------------------------------
         *  CACHE ASSETS
         * -----------------------------------------
         *  Cache static resources from assets 
         *  including constants, color schemes,
         *  language translations and views.
         * -----------------------------------------
         */

        'assets'       => [

            'locale'   => true,

            'constant' => true,

        ],

        /**
         * -----------------------------------------
         *  CACHE CONFIG
         * -----------------------------------------
         *  Cache static resources from config files
         *  except this configuration file.
         * -----------------------------------------
         */

        'config'       => [

            'app'           => true,

            'handler'       => true,

            'security'      => true,

        ],

        /**
         * -----------------------------------------
         *  CACHE ROUTES
         * -----------------------------------------
         *  Cache routes data to avoid frequent 
         *  loading and Route Object creation in
         *  each request.
         * -----------------------------------------
         */

        'routes'       => true,

    ];