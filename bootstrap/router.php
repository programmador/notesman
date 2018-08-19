<?php

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', [new App\Controllers\TaskController, 'create']);
    $r->addRoute('POST', '/task/save', [new App\Controllers\TaskController, 'save']);
    $r->addRoute('GET', '/task/{id:\d+}', [new App\Controllers\TaskController, 'show']);
    $r->addRoute('GET', '/user/create_random', [new App\Controllers\UserController, 'createRandom']);
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

return $routeInfo;
