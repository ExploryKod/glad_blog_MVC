<?php

use Gladblog\Container\AppContainer;
use Gladblog\Controllers\AbstractController;
use Gladblog\Route\Route;

require_once 'vendor/autoload.php';

$app = new AppContainer();
$app->session()->start();

$controllerDir = dirname(__FILE__) . '/src/Controllers';

$dirs = scandir($controllerDir);
$controllers = [];

foreach ($dirs as $dir) {
    if ($dir === "." || $dir === "..") {
        continue;
    }

    $className = "Gladblog\\Controllers\\" . pathinfo($controllerDir . DIRECTORY_SEPARATOR . $dir)['filename'];

    // Ignorer la classe abstraite et les helpers sans routes
    if ($className === AbstractController::class || !class_exists($className)) {
        continue;
    }

    $reflection = new ReflectionClass($className);
    if ($reflection->isAbstract()) {
        continue;
    }

    $controllers[] = $className;
}

$routesObj = [];

foreach ($controllers as $controller) {
    $reflection = new ReflectionClass($controller);

    foreach ($reflection->getMethods() as $method) {
        foreach ($method->getAttributes() as $attribute) {
            /** @var Route $route */
            $route = $attribute->newInstance();
            $route->setController($controller)
                ->setAction($method->getName());

            $routesObj[] = $route;
        }
    }
}

$url = "/" . trim(explode("?", $_SERVER['REQUEST_URI'])[0], "/");

foreach ($routesObj as $route) {
    if (!$route->match($url) || !in_array($_SERVER['REQUEST_METHOD'], $route->getMethods(), true)) {
        continue;
    }

    $controlerClassName = $route->getController();
    $action = $route->getAction();
    $params = $route->mergeParams($url);

    new $controlerClassName($app, $action, $params);
    exit();
}

require_once('views/404.php');

die;
