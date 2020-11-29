<?php

namespace src;

use R;

class Db
{
    public function __construct()
    {
        require_once __DIR__.'/../rb-mysql.php';
        $host = Config::$dbHost;
        $dbname = Config::$dbName;
        $dbuser = Config::$dbUser;
        $dbpass = Config::$dbPass;
        R::setup("mysql:host=$host;dbname=$dbname", "$dbuser", "$dbpass");
        R::fancyDebug(true);
    }
}
