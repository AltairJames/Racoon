<?php

    /**
     * -----------------------------------------
     *  PHP CLASS AUTOLOADER
     * -----------------------------------------
     *  Load PHP classes without the need of
     *  include or require function.
     * -----------------------------------------
     */

    require 'autoload.php';

    /**
     * -----------------------------------------
     * RACOON APPLICATION
     * -----------------------------------------
     * Create application instance.
     * -----------------------------------------
     */

    $app = Racoon\Core\Application::init();

    /**
     * -----------------------------------------
     * SERVICES 
     * -----------------------------------------
     * Start all services during runtime.
     * -----------------------------------------
     */

    $app->start();

    /**
     * -----------------------------------------
     * APP TERMINATION
     * -----------------------------------------
     * This is important to formalize the closing
     * of each request.
     * -----------------------------------------
     */

    $app->exit();