<?php

//use Gladblog\Controllers\PostController;
//use Symfony\Component\Yaml\Yaml;
//require_once "vendor/autoload.php";
//$yaml = Yaml::parseFile(dirname(__FILE__) . "/config/routes.yml");
//$controller = new PostController();

use Gladblog\Route\Route;

require_once 'vendor/autoload.php';

$controllerDir = dirname(__FILE__) . '/src/Controllers';

$dirs = scandir($controllerDir);
$controllers = [];

foreach ($dirs as $dir) {
    if ($dir === "." || $dir === "..") {
        continue;
    }

    $controllers[] = "Gladblog\\Controllers\\" . pathinfo($controllerDir . DIRECTORY_SEPARATOR . $dir)['filename'];
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

// trim pour supprimer les slash en début et en fin de chaîne (ce qui fait que je rajoute ensuite afin d'avoir de la lisibilité mais c pas obligé)
$url = "/" . trim(explode("?", $_SERVER['REQUEST_URI'])[0], "/");

foreach ($routesObj as $route) {
    if (!$route->match($url) || !in_array($_SERVER['REQUEST_METHOD'], $route->getMethods())) {
        continue;
    }

    $controlerClassName = $route->getController();
    $action = $route->getAction();
    $params = $route->mergeParams($url);

    new $controlerClassName($action, $params);
    exit();
}

require_once('views/404.php');

die;