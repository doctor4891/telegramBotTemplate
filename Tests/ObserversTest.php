<?php

namespace Tests;

use src\Db;
use src\Config;
use src\Subject;
use src\Telegram;
use PHPUnit\Framework\TestCase;

class ObserversTest extends TestCase
{
    public function setUp(): void
    {
        (new Db());
    }

    public function testStartCheck()
    {
        $inputData = '{"update_id":724433521,
"message":{"message_id":6,"from":{"id":392832582,"is_bot":false,"first_name":"\u221e","username":"tg2020ukraine","language_code":"ru"},"chat":{"id":392832582,"first_name":"\u221e","username":"tg2020ukraine","type":"private"},"date":1606672917,"text":"/start","entities":[{"offset":0,"length":6,"type":"bot_command"}]}}';

        $this->Checker($inputData, 'Start');
    }

    /**
     * Bypass all observers and check it.
     */
    private function Checker(string $inputData, string $className): void
    {
        $myTele = new Telegram(Config::$token, json_decode($inputData));
        $subject = new Subject($myTele);
        foreach ($subject->observers as $observer) {
            $class = 'src\\'.$observer['name'];

            $command = new $class($subject->telegram);
            if ($command->check()) {
                $this->assertEquals($className, $observer['name']);
            } else {
                $this->assertNotEquals($className, $observer['name']);
            }
        }
    }
}
