#!/usr/bin/env php
<?php
// application.php

require __DIR__.'/../vendor/autoload.php';

use Symfony\Component\Console\Application;

$application = new Application();

$application->add(new \XRPHP\Command\GenerateTypesCommand());
$application->add(new \XRPHP\Command\GenerateMethodsCommand());

$application->run();
