<?php

    require __DIR__.'/../vendor/autoload.php';

    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();

    $routeInfo = require_once __DIR__.'/../bootstrap/router.php';
    switch ($routeInfo[0]) {
        case FastRoute\Dispatcher::NOT_FOUND:
            throw new Exception("HTTP 404 NOT FOUND");
            break;
        case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
            $allowedMethods = $routeInfo[1];
            throw new Exception("HTTP 405 METHOD NOT ALLOWED");
            break;
        case FastRoute\Dispatcher::FOUND:
            $handler = $routeInfo[1];
            $vars = $routeInfo[2];
            call_user_func_array($handler, $vars);
            break;
    }

?>