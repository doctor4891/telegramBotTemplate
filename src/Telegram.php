<?php

namespace src;

use R;
use Exception;
use TelegramBot\Api\BotApi;

class Telegram
{
    public $bot;

    public $log;

    public $inputData;

    public $state;

    public function __construct(string $token, object $inputData = null)
    {
        /*for tests*/
        if ($inputData == null) {
            $this->inputData = $this->getInputData();
        } else {
            $this->inputData = $inputData;
        }

        $this->bot = new BotApi($token);

        /*last Observers of this user id*/
        $this->state = R::getAll('select observer from states where userid=?', [$this->inputData->message->from->id]);
    }

    /**
     * @throws Exception
     *                   Get data from telegram
     *
     * @return mixed
     */
    private function getInputData()
    {
        $json = file_get_contents('php://input');
        if (!isset($json) or $json == null or $json == false or $json == '') {
            throw new Exception('cannot get telegram input data');
        }
        $data = json_decode($json);

        return $data;
    }
}
