<?php

use App\Foundation\Application;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$application = new Application();
$application->init();

$application->run();
