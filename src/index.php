<?php

# const
define('ROOT_DIR', dirname(__DIR__));

# autoload;
require_once("autoload.php");

# set ini;
session_start();
date_default_timezone_set('Asia/Seoul');
ini_set('memory_limit','128M');
header('Access-Control-Allow-Origin: *');

# execute script;
$apiLoader = new Saseul\Common\ApiLoader();
$apiLoader->main();

# TODO: Making debug mode