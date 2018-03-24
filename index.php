<?php
require_once 'vendor/autoload.php';

$version_compare = version_compare($version = phpversion(), 7.0, '<');
if ($version_compare) {
    exit(sprintf('You are running PHP %s, but Rocket CMF needs at least PHP 7.0 to run.', $version));
}

Framework\Application::run();
