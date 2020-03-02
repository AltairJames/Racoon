<?php

    if(function_exists('spl_autoload_register')) {

        spl_autoload_register(function(string $class) {

            $file = null;
            $ext = '.php';
            $server_root = '../';
            $paths = [

                'app'       => 'app/',

                'db'        => 'database/',

                'racoon'    => 'system/',

            ];

            $startwith = strtolower(explode('\\', $class)[0]);
            $keys = array_keys($paths);            
            
            for($i = 0; $i <= (sizeof($keys) - 1); $i++) {
                if($keys[$i] === $startwith) {
                    $file = $server_root . $paths[$keys[$i]] . str_replace('\\', '/', substr($class, strlen($startwith) + 1, strlen($class))) . $ext;
                    break;
                }
            }

            if(is_null($file)) {
                $file = $server_root . 'vendor/' . str_replace('\\', '/', $class) . $ext;
            }

            if(file_exists($file) && is_readable($file)) {
                require $file;
            }

        });

    }