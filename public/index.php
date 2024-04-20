<?php

define('APP', dirname(__DIR__));
include '../vendor/autoload.php';
include APP . '/config/variables.php';

$app = new \App\App();
$app->run();