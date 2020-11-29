<?php

namespace src;

class Subject
{
    public $observers;

    public $telegram;

    public function __construct(Telegram $myTele)
    {
        $this->telegram = $myTele;
        /*Get list of all classes subscribers*/
        $this->observers = \R::getAll('select name from observers');
    }

    public function notify()
    {
        $result = false;
        /* bypass all classes */
        foreach ($this->observers as $observer) {
            $class = 'src\\'.$observer['name'];

            $command = new $class($this->telegram);
            if ($command->update()) {
                $result = true;
                break;
            }
        }
    }
}
