<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
date_default_timezone_set (@date_default_timezone_get());
set_time_limit(0);

define('APPLICATION_ENV', 'testing');

require_once(__DIR__  . '/../vendor/autoload.php');