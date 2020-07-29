#!/usr/bin/env php
<?php

require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Application;
use Console\FirstCommand;

$app = new Application("First Console App for Task");
$app->add(new FirstCommand());
$app->run();
