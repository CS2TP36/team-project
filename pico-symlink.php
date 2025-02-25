<?php

// This is a file which creates a symlink to the pico directory in the public directory and is run by composer at the end of install or update

// make sure it is using packages in autoload.php
require __DIR__ . '/vendor/autoload.php';

// use php filesystem component for handling cross-platform filesystems
use Symfony\Component\Filesystem\Filesystem;
$filesystem = new Filesystem();

// create the symlink to the pico directory, or copy it on windows
$filesystem->symlink(__DIR__ . '/vendor/picocss/pico', __DIR__ . '/public/pico', true);
