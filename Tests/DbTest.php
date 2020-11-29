<?php

namespace Tests;

use R;
use src\Db;
use PHPUnit\Framework\TestCase;

class DbTest extends TestCase
{
    public function testDbConnection()
    {
        new Db();
        $this->assertTrue(R::testConnection());
    }
}
