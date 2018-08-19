<?php

    require __DIR__.'/../vendor/autoload.php';

    $routeInfo = require_once __DIR__.'/../bootstrap/router.php';
    // @TODO use filp/whoops or similar library for both route mismatch and handler failure handling
    switch ($routeInfo[0]) {
        case FastRoute\Dispatcher::NOT_FOUND:
            //throw new Exception("HTTP 404 NOT FOUND");
            echo "HTTP 404 NOT FOUND";
            break;
        case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
            $allowedMethods = $routeInfo[1];
            //throw new Exception("HTTP 405 METHOD NOT ALLOWED");
            echo "HTTP 405 METHOD NOT ALLOWED";
            break;
        case FastRoute\Dispatcher::FOUND:
            $handler = $routeInfo[1];
            $vars = $routeInfo[2];
            call_user_func_array($handler, $vars);
            break;
    }

?>