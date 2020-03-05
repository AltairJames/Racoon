<?php

    return [

        /**
         * -----------------------------------------
         *  PROJECT DEPLOYMENT STATUS
         * -----------------------------------------
         *  Automatically disable caching and show
         *  error messages when deployment is in
         *  debug mode. If deployment is in release
         *  mode, enable caching and hide error 
         *  messages to protect vital informations
         *  about your application.
         * -----------------------------------------
         */

        'release'      => 'debug',

        /**
         * -----------------------------------------
         *  APP VISIBILITY
         * -----------------------------------------
         *  Return HTTP status code 503 when down.
         * -----------------------------------------
         */

        'mode'         => 'up',

        /**
         * -----------------------------------------
         *  APPLICATION INFO
         * -----------------------------------------
         *  Informations about your application.
         * -----------------------------------------
         */

        'info'         => [

            'name'          => 'Untitled Application',

            'description'   => '',

            'version'       => '',

            'author'        => '',

            'company'       => '',

            'address'       => '',

            'email'         => '',

            'contact'       => '',

        ],

        /**
         * -----------------------------------------
         *  LOCAL TIMEZONE
         * -----------------------------------------
         *  Set server and MySQL timezone.
         * -----------------------------------------
         */

        'timezone'     => 'Asia/Manila',

        /**
         * -----------------------------------------
         *  LOCALIZATION
         * -----------------------------------------
         *  Set the default language translation of 
         *  all text resource. If no translation 
         *  from the default locale, fallback locale
         *  (locale2) will be used as reference
         *  language translation.
         * -----------------------------------------
         */

        'locale'       => 'en',

        'locale2'      => 'en',

        /**
         * -----------------------------------------
         *  MINIFY SOURCE CODE
         * -----------------------------------------
         *  Increase loading efficiency by removing
         *  all whitespaces and comments from your
         *  code to decrease loading time.
         * -----------------------------------------
         */

        'minify'       => true,

    ];