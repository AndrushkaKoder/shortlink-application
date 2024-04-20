<?php

define('APP', dirname(__DIR__));
include '../vendor/autoload.php';
include APP . '/config/variables.php';
include APP . '/app/Helpers/functions.php';

use Kernel\App;

session_start();

$application = new App();
$application->run();