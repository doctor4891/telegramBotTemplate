<?php

namespace src;

class Start extends Observer
{
    public function update()
    {
        if ($this->check()) {
            $this->telegram->bot->sendMessage($this->telegram->inputData->message->chat->id,
                'Привет',
                'HTML'
                );
        }
    }

    public function check()
    {
        if (!isset($this->telegram->inputData->message->text)) {
            return false;
        }
        if ($this->telegram->inputData->message->text !== '/start') {
            return false;
        }

        return true;
    }
}
