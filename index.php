<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('max_execution_time', 100);
use src\Db;
use src\Config;
use src\Subject;
use src\Telegram;

require_once __DIR__.'/vendor/autoload.php';
(new Db());
$myTele = new Telegram(Config::$token);
$subject = new Subject($myTele);
$subject->notify();
