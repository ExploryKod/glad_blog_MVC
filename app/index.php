<?php

use Gladblog\Controller\PostController;
use Symfony\Component\Yaml\Yaml;

require_once "vendor/autoload.php";

$yaml = Yaml::parseFile(dirname(__FILE__) . "/config/routes.yml");
var_dump($yaml); die;

$controller = new PostController();